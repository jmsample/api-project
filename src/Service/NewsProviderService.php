<?php

namespace JournalMedia\Sample\ApiProject\Service;

use JournalMedia\Sample\ApiProject\Service\StaticContentProviderService;
use JournalMedia\Sample\ApiProject\Transformer\HtmlTransformer;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NewsProviderService
{
    private HttpClientInterface $httpClient;

    private StaticContentProviderService $staticContentProviderService;

    private HtmlTransformer $htmlTransformer;

    private array $allowedTags = ['google', 'apple'];

    const PUBLICATION = 'thejournal';

    public function __construct(
        HttpClientInterface $httpClient,
        StaticContentProviderService $staticContentProviderService,
        HtmlTransformer $htmlTransformer
    ) {
        $this->httpClient = $httpClient;
        $this->staticContentProviderService = $staticContentProviderService;
        $this->htmlTransformer = $htmlTransformer;
    }

    public function getNewsContent(string $tag = null) : string
    {
        $demoMode = $_ENV['DEMO_MODE'];

        if (isset($tag) && $demoMode ==='true' && !in_array($tag, $this->allowedTags)) {
            return 'Tag not allowed';
        }

        $staticContent = $this->staticContentProviderService->getStaticContent($demoMode, $tag);
        if (!is_null($staticContent)) {
            $content['response']['articles'] = $staticContent;
            return $this->htmlTransformer->outputTransformer($content);
        }

        if ($demoMode === 'false') {

            $url = $this->getUrl($tag);

            $username = $_ENV['API_USER'];
            $password = $_ENV['API_PASSWD'];

            $response = $this->httpClient->request('GET', $url,
                [
                    'auth_basic' => [
                        $username,
                        $password
                    ]
                ],
                [
                    'response_headers' => ['Content-Type: application/json']
                ]
            );
            $content = json_decode($response->getContent(), true);
            return $this->htmlTransformer->outputTransformer($content);
        }
    }


    private function getUrl(string $tag = null) : string
    {
        if (isset($tag)) {
            return $_ENV['API_URL'] . "tag/" . $tag;
        }
        return $_ENV['API_URL'] . self::PUBLICATION;
    }
}