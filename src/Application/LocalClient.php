<?php

namespace JournalMedia\Sample\ApiProject\Application;

final class LocalClient implements HomePageRiverClient, TagRiverClient
{
    private string $path;

    public function __construct(string $path = '../resources/demo-responses/')
    {
        $this->path = $path;
    }

    public function requestHomePageRiver(string $identifier): string
    {
        if ("thejournal" !== $identifier) {
            throw new \RuntimeException("No content found for $identifier");
        }

        return $this->requestContent($identifier);
    }

    public function requestTagRiver(string $identifier): string
    {
        if ($identifier != "google" && $identifier != "apple") {
            throw new \RuntimeException("No content found for $identifier");
        }
        return $this->requestContent($identifier);
    }

    private function requestContent(string $filePath): string
    {
        $fullPath = "$this->path$filePath.json";
        return file_get_contents($fullPath);
    }
}
