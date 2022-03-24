<?php

namespace JournalMedia\Sample\ApiProject\Repositories\River;

class APIRiverRepository implements RiverRepositoryInterface
{
    private $url;
    private $username;
    private $pass;

    public function __construct(){
        $this->url = $_ENV['THE_JOURNAL_API_URL'];
        $this->username = $_ENV['THE_JOURNAL_API_USERNAME'];
        $this->pass = $_ENV['THE_JOURNAL_API_PASSWORD'];
    }

    public function getRiver()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url .'sample',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_USERPWD => "$this->username:$this->pass"
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response);

        return (!empty($result) && $result->status === true) ? $result->response->articles : null;
    }

    public function getRiverByTag($tag)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url ."sample/tag/{$tag}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_USERPWD => "$this->username:$this->pass"
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);

        return (!empty($result) && $result->status === true) ? $result->response->articles : null;
    }
}