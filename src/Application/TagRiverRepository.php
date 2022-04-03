<?php

namespace JournalMedia\Sample\ApiProject\Application;

final class TagRiverRepository
{
    private TagRiverClient $client;
    private PostProcessor $postProcessor;

    public function __construct(TagRiverClient $client, PostProcessor $postProcessor)
    {
        $this->client = $client;
        $this->postProcessor = $postProcessor;
    }

    function getPostsForTag(string $tag): array
    {
        $response = $this->client->requestTagRiver($tag);

        return $this->postProcessor->processPosts($response);
    }
}
