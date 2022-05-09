<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;

class AuthToken implements FilterInterface
{

    use ResponseTrait;

    public function before(RequestInterface $request, $arguments = null)
    {
       try {
        $key = Services::getSecretKey();
        $header = $request->getServer('HTTP_AUTHORIZATION');

        if(!$header) {
            return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED, 'No se ha enviado el token.');
        }

        $arr = explode(' ', $header);
        $jwt = $arr[1];
        JWT::decode($jwt, new Key($key, 'HS256'));
       } catch (ExpiredException $expired) {
            return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED, 'El token se ha vencido.');
       } catch (\Exception $error) {
            return Services::response()->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR, 'Ocurrio un error en el servidor, hable con el administrador.');
       }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}