<?php
use Firebase\JWT\JWT;
use Config\Services;

function generateToken($username) {
    $key = Services::getSecretKey();
    $time = time();
    $payload = [
        'aud' => base_url(),
        'iat' => $time,
        'exp' => $time + 60,
        'username' => $username
    ];
    $jwt = JWT::encode($payload, $key, 'HS256');
    return $jwt;
}

