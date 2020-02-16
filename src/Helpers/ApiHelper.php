<?php

namespace JournalMedia\Sample\Helpers;

use GuzzleHttp\Client;

class ApiHelper
{
    /**
     * api call with guzzle
     */
    public static function makeApiCall($url, $user, $pass)
    {
        try {
            $client = new Client();
            $response = $client->get($url, [
                'auth' => [
                    $user,
                    $pass
                ]
            ]);
            return $response;
        } catch (RequestException $e) {
        }
    }
}