<?php

namespace JournalMedia\Sample\ApiProject\Application;

final class HomepageRiverRepository
{
    private HomePageRiverClient $client;
    private PostProcessor $postProcessor;

    public function __construct(HomePageRiverClient $client, PostProcessor $postProcessor)
    {
        $this->client = $client;
        $this->postProcessor = $postProcessor;
    }

    function getPosts(string $publication): array
    {
        $response = $this->client->requestHomePageRiver($publication);

        return $this->postProcessor->processPosts($response);
    }
}
