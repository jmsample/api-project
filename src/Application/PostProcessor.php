<?php

namespace JournalMedia\Sample\ApiProject\Application;

final class PostProcessor
{
    /**
     * Receives a json encoded collection of articles.
     * Takes the articles that have their type set as "post",
     * and returns a "Post" object array.
     * @param string $response
     * @return array
     */
    public function processPosts(string $response): array
    {
        $jsonResponse = json_decode($response, true);

        $jsonResponse = array_filter($jsonResponse, fn(array $article) => $article['type'] == 'post');

        return array_map(fn(array $post) => Post::fromArray($post), $jsonResponse);
    }
}
