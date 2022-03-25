<?php

namespace JournalMedia\Sample\ApiProject\Service;

interface RiverDatasourceInterface
{
    public function getArticlesByPublication(string $publicationName, array $extraOptions = []);

    public function getArticlesByTag(string $tagName, array $extraOptions = []);
}