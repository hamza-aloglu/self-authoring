<?php

namespace app\controllers;

class CurlController
{
    public function getEmailState(string $email) : string
    {
        $params = [
            'email' => $email,
            'api_key' => $_ENV['EMAILLABLE_KEY']
        ];

        $url = 'https://api.emailable.com/v1/verify?' . http_build_query($params);
        $handle = curl_init($url);

        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        $result = (array)json_decode(curl_exec($handle));
        return $result['state'];
    }
}