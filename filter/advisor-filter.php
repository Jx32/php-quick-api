<?php
namespace com\atomicdev\filter;
use com\atomicdev\dao\ExceptionDAO;
use com\atomicdev\database\ResidentialPdoClient;
use com\atomicdev\exception\ApiException;
use com\atomicdev\request\BaseHttpResponse;
use com\atomicdev\request\V1Request;
use PDOException;
include_once("$root/request/v1-request.php");
include_once("$root/request/base-http-response.php");
include_once("$root/exception/api-exception.php");
include_once("$root/dao/exception-dao.php");
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
        } catch (ApiException $ae) {
            $db = ResidentialPdoClient::getConnection($request->getEnvs());
            $exceptionDao = new ExceptionDAO($db);
            $exceptionDao->createErrorLog($ae, $request);

            $response->setResponse($ae->getMessage());
            $response->setResponseCode($ae->getCode());
        } catch (PDOException $e) {
            $db = ResidentialPdoClient::getConnection($request->getEnvs());
            $exceptionDao = new ExceptionDAO($db);
            $exceptionDao->createErrorLog($e, $request);

            $response->setResponse("Database error: " . $e->getMessage());
            $response->setResponseCode(500);
        } finally {
            if ($db !== null) {
                $db = null;
            }
        }
    }
}
?>