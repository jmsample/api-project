<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Repository;

use JournalMedia\Sample\Helpers\ApiHelper;

class ApiRiverRepository extends RiverFactory implements RiverRepositoryInterface
{

    private $url;
    private $pass;
    private $userName;

    public function __construct($url, $userName, $pass)
    {
        $this->url = $url;
        $this->pass = $pass;
        $this->userName = $userName;
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