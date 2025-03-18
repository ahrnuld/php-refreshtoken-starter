<?php

namespace Controllers;

use Services\UserService;
use Firebase\JWT\JWT;

class UserController extends Controller
{
    private $service;

    // initialize services
    function __construct()
    {
        $this->service = new UserService();
    }

    public function login()
    {

        // read user data from request body
        $loginData = $this->createObjectFromPostedJson("Models\\User");

        // get user from db
        $user = $this->service->checkUsernamePassword($loginData->username, $loginData->password);

        // if the method returned false, the username and/or password were incorrect
        if (!$user) {
            $this->respondWithError(401, "Incorrect username and/or password");
            return;
        }

        // TODO: Generate and store refresh token

        // generate jwt
        $key = 'banaan';

        $payload = [
            'iss' => 'http://example.org',
            'aud' => 'http://example.com',
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + 10,
            'sub' => $user->username,
            'data' => [
                'username' => $user->username, 
                'email' => $user->email
            ]
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');

        // return jwt
        $this->respond($jwt);
    }

    public function refresh()
    {
        // TODO: Check refresh token and return new JWT + refresh token if valid
    }

}
