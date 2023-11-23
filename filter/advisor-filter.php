<?php
namespace com\atomicdev\filter;
use com\atomicdev\dao\ApiMapper;
use com\atomicdev\dao\LogDAO;
use com\atomicdev\database\ResidentialPdoClient;
use com\atomicdev\exception\ApiException;
use com\atomicdev\exception\BadRequestException;
use com\atomicdev\exception\ResourceNotFoundException;
use com\atomicdev\request\BaseHttpResponse;
use com\atomicdev\request\V1Request;
use Exception;
use PDOException;

include_once("$root/request/v1-request.php");
include_once("$root/request/base-http-response.php");
include_once("$root/exception/api-exception.php");
include_once("$root/exception/bad-request-exception.php");
include_once("$root/exception/resource-not-found-exception.php");
include_once("$root/dao/log-dao.php");
include_once("$root/dao/api-mapper.php");
include_once("$root/database/residential-pdo-client.php");
include_once("filter.php");
include_once("filter-chain.php");

/*
    This filter catches all API or Security exceptions then
    returns a friendly and formatted response.
    This filter must be at the top of the filter chain.
*/
class AdvisorFilter implements Filter {
    public function filter(V1Request &$request, BaseHttpResponse &$response, FilterChain $filterChain) {
        $db = null;
        try {
            $filterChain->doChain($request, $response);
            
        } catch (PDOException $e) {
            $this->handlePdoExceptions($e, $request, $response);

        } catch (BadRequestException | ResourceNotFoundException | ApiException $e) {
            $this->logErrorOnDatabase($e, $request, $response);
            $response->setResponse($e->getMessage());
            $response->setResponseCode($e->getCode());
        } finally {
            if ($db !== null) {
                $db = null;
            }
        }
    }

    private function handlePdoExceptions(PDOException $e, V1Request &$request, BaseHttpResponse &$response) : void {
        if ($e->getCode() == 23505) {
            $response->setResponse("Unique key violation: " . $e->getMessage());
            $response->setResponseCode(409);
        } else if ($e->getCode() == 23502) {
            $response->setResponse("Missing required field: " . $e->getMessage());
            $response->setResponseCode(400);
        } else {
            $this->logErrorOnDatabase($e, $request, $response);
            $response->setResponse("Database error: " . $e->getMessage());
            $response->setResponseCode(500);
        }
    }

    private function logErrorOnDatabase(Exception $e, V1Request &$request, BaseHttpResponse &$response) : void {
        $db = ResidentialPdoClient::getConnection($request->getEnvs());
        $log = ApiMapper::mapErrorLog($e, $request);
        $logDao = new LogDAO($db);
        $logDao->createLog($log);
    }
}
?>