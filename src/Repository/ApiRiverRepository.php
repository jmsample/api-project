<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Repository;

use JournalMedia\Sample\Helpers\ApiHelper;

class ApiRiverRepository extends RiverFactory implements RiverRepositoryInterface
{
    private $url;
    private $pass;
    private $userName;

    public function __construct($params)
    {
        $this->url = isset($params['url']) ? $params['url'] : getenv('API_URL');
        $this->pass = isset($params['pass']) ? $params['pass'] : getenv('API_PASS');
        $this->userName = isset($params['user']) ? $params['user'] : getenv('API_USERNAME');
    }

    public function getPublications(string $slug = null): array
    {
        //get all journal articles
        $url = $this->url . 'thejournal/';
        if (!empty($slug)) {
            //get only by tag articles
            $url = $this->url . 'tag/' . $slug;
        }
        $response = ApiHelper::makeApiCall($url, $this->userName, $this->pass);
        $contents = json_decode($response->getBody()->getContents(), true);
        return $contents['response']['articles'];
    }

}