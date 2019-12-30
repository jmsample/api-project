<?php
declare(strict_types=1);
namespace JournalMedia\Sample\Classes;
use GuzzleHttp\Client;
use JournalMedia\Sample\Interfaces\DataProviderInterface;
use JournalMedia\Sample\Model\Article;

Class APIProvider implements DataProviderInterface 
{
    private $APIAuthUsername;
    private $APIAuthPassword;

    const APIURL = 'https://api.thejournal.ie/v3/sample/';

    function __construct() {
        $this->APIAuthUsername = getenv('API_USERNAME');
        $this->APIAuthPassword = getenv('API_PASSWORD');
    }

    public function getByPublication(string $publication)
    {
        return $this->getData($publication);
    }

    public function getByTag(string $tag)
    {
        return $this->getData('tag/'.$tag);
    }

    private function getData(string $endpoint) {
        try {
            $client = new Client();
            $response = $client->request('GET', self::APIURL.$endpoint, [
                'auth' => [$this->APIAuthUsername, $this->APIAuthPassword]
            ]);

            if ($response->getStatusCode() !== 200) {
                throw new \Exception('Data could not be retrieved from the API');
            }
            $responseContents = json_decode($response->getBody()->getContents());

            $articles = [];
            foreach ($responseContents->response->articles as $article) {
                if ($article->type === 'post') {
                    $articles[] = new Article(  $article->title,
                                                $article->excerpt,
                                                $article->images->thumbnail->image);
                }
            }
            return $articles;

        } catch(\Exception $e) {
            return [];
        }
    }
}