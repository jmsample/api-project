<?php

namespace JournalMedia\Sample\ApiProject\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class HelperService
{
    public function __construct(private HttpClientInterface $client)
    {
    }

    public function callApi($url) 
    {
        $response = $this->client->request('GET', $url);
        $content = $response->getContent();
        return $content;
    }

    public function getFormatedArticles($articles)
    {
        $newContent = "";
        foreach ($articles as $article) {

            if (($article["type"]) == "post") {
                $newContent = $newContent . <<<STR
                <div>
                <h2>{$article['title']}</h2> 
                <div><img src='{$article["images"]["medium"]["image"]}' /></div>
                <div> {$article['excerpt']} </div>
                <div> </div> 
                </div>
                </br>
                <hr> 
            STR;
            }
        }

        return $newContent;
    }
}