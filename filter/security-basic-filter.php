<?php
namespace com\atomicdev\filter;
use com\atomicdev\exception\ApiException;
use com\atomicdev\request\BaseHttpResponse;
use com\atomicdev\request\V1Request;
include_once("$root/request/v1-request.php");
include_once("$root/request/base-http-response.php");
include_once("$root/exception/api-exception.php");
include_once("filter.php");
include_once("filter-chain.php");

/*
    This filter validates security Basic headers each
    request
*/
class SecurityBasicFilter implements Filter {
    const AUTH_URL_SUFFIX = "/auth";
    const AUTHORIZATION = "Authorization";
    const USERNAME = "username";
    const PASSWORD = "password";

    public function filter(V1Request &$request, BaseHttpResponse &$response, FilterChain $filterChain) {
        if (!str_contains($request->getUrl(), self::AUTH_URL_SUFFIX)) {

            if (isset($request->getHeaders()[self::AUTHORIZATION])) {

                $tokenHeader = $request->getHeaders()[self::AUTHORIZATION];
                $token = $this->extractToken($tokenHeader);
                $user = $this->extractUser($token);
                $this->validateUser($user, $request);

            } else {
                throw new ApiException("Unauthorized", 401);
            }
        }

        $filterChain->doChain($request, $response);
    }

    private function extractToken(string|null $tokenHeader) : string|null {
        if (!is_null($tokenHeader)) {
            $replacedHeader = str_replace(" ", "",
                str_replace("Basic", "", $tokenHeader));
            
            return $replacedHeader;
        }
        return null;
    }

    private function extractUser(string $token) : BasicUser {
        $decodedToken = base64_decode($token);

        if ($decodedToken === false) {
            throw new ApiException("Unauthorized", 401);
        }

        $parts = explode(":", $decodedToken);

        return new BasicUser(
            $parts[0],
            $parts[1]
        );
    }

    private function validateUser(BasicUser $user, V1Request $request) : void {
        if ($user->getUsername() !== $request->getEnv(self::USERNAME) ||
            $user->getPassword() !== $request->getEnv(self::PASSWORD)) {
                throw new ApiException("Unauthorized", 401);
            }
    }
}

class BasicUser {
    private $username;
    private $password;

    public function __construct(string $username, string $password) {
        $this->username = $username;
        $this->password = $password;
    }
    public function getUsername() : string {
        return $this->username;
    }
    public function getPassword() : string {
        return $this->password;
    }
    public function __toString() : string {
        return $this->username .":". $this->password;
    }
}
?>