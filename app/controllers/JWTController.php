<?php

declare(strict_types=1);


namespace app\controllers;

use app\attributes\Route;
use app\models\JWT;

class JWTController
{
    #[Route('post', '/self-authoring/isValidJWT')]
    public function isValidJWT()
    {
        $jwtToken = json_decode(file_get_contents('php://input', true));

        $jwt = new JWT();
        $isValid = true;
        try{
            $jwt->decode($jwtToken);
        } catch (\Exception $e) {
            $isValid = false;
        }

        echo json_encode($isValid);
    }
}