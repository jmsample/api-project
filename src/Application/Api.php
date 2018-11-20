<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Application;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use GuzzleHttp\Client as HttpClient;

class Api {

    public function __construct() {
        $log = new Logger('Api');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../../logs/errors.log', Logger::WARNING));

        $this->log = $log;
    }

    public function sendRequest($url, $method = 'GET') {
        $baseUrl = getenv('API_BASE_URL');
        $username = getenv('API_USERNAME');
        $password = getenv('API_PASSWORD');
        $data = [];

        $client =  new HttpClient();

        try {
            $response = $client->request($method, $baseUrl . $url, [
                [
                    'auth' => [$username, $password],
                    'form_params' => ['username' => $username, 'password' => $password]
                ]
            ]);
            $status = $response->getStatusCode();
            $data = $response->getBody();
        } catch (\Exception $e) {
            $status = $e->getCode();
            $message = $e->getMessage();
            $this->log->error($status . ' - ' . $message);
        }

        return [
            'status' => $status,
            'data' => $this->filterPosts($data),
        ];
    }

    public function getMockResponse($tag = null) {
        $samplesPath = __DIR__ . '/../../resources/demo-responses/';
        $filePath = $samplesPath . (!empty($tag) ? $tag : 'thejournal') . '.json';
        $status = 200;
        $data = [];

        if (file_exists($filePath)) {
            $data = json_decode(file_get_contents($filePath), true);
            $data = $this->filterPosts($data);
        } else {
            $status = 404;
        }

        return [
            'status' => $status,
            'data' => $data,
        ];

    }

    public function getArticles($tag = null, $publication = 'thejournal') {
        $demoMode = filter_var(getenv('DEMO_MODE'), FILTER_VALIDATE_BOOLEAN);

        if ($demoMode) {
            $response = $this->getMockResponse($tag);
        } else {
            $url = "/sample/$publication" . (!empty($tag) ? "/$tag" : '');
            $response = $this->sendRequest($url);
        }

        $response['publication'] = $this->formatPublicationName($publication);
        $response['tag'] = $tag;

        return $response;
    }

    public function filterPosts($array) {
        $filtered = [];

        foreach ($array as $element) {
            if ($element['type'] === 'post') {
                $filtered[] = $element;
            }
        }

        return $filtered;
    }

    public function formatPublicationName($name) {
        switch (strtolower($name)) {
            case 'thejournal':
                $name = 'TheJournal';
                break;
            case 'thescore':
                $name = 'TheScore';
                break;
            case 'thedailyedge':
                $name = 'TheDailyEdge';
                break;
            case 'businessetc':
                $name = 'BusinessEtc';
                break;
        }

        return $name;
    }

}