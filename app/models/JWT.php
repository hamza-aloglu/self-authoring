<?php

namespace app\models;

use app\Model;
use Firebase\JWT\JWT as JWTfirebase;
use Firebase\JWT\Key;

class JWT extends Model
{
    private string $secretKey;
    private string $jwtAlgo;

    public function __construct()
    {
        parent::__construct();
        $this->secretKey = $_ENV['JWT_SECRET'];
        $this->jwtAlgo = $_ENV['JWT_ALGO'];
    }

    public function create(array $payload): string
    {
        return JWTfirebase::encode($payload, $this->secretKey, $this->jwtAlgo);
    }

    public function decode(string $jwtToken)
    {
        JWTfirebase::decode($jwtToken, new Key($this->secretKey, $this->jwtAlgo));
    }
}