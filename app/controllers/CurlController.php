<?php

declare(strict_types=1);

namespace app\controllers;

use app\interfaces\IEmailState;
use app\types\DeliverableEmail;
use app\types\RiskyEmail;
use app\types\UndeliverableEmail;
use app\types\UnknownEmail;

class CurlController
{
    public function getEmailState(string $email): IEmailState
    {
        $result = $this->fetchFromEmaillableAPI($email);
        $state = $result['state'];

        if ($state === 'deliverable') {
            return new DeliverableEmail(); // action.equals
        } else if ($state === 'risky') {
            return new RiskyEmail();
        } else if ($state === 'undeliverable') {
            return new UndeliverableEmail();
        }
        return new UnknownEmail();
    }

    private function fetchFromEmaillableAPI(string $email): array
    {
        $params = [
            'email' => $email,
            'api_key' => $_ENV['EMAILLABLE_KEY']
        ];

        $url = 'https://api.emailable.com/v1/verify?' . http_build_query($params);
        $handle = curl_init($url);

        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);


        return (array)json_decode(curl_exec($handle));
    }
}