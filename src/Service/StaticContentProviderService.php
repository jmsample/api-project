<?php

namespace JournalMedia\Sample\ApiProject\Service;

class StaticContentProviderService
{
    const PUBLICATION = 'thejournal';

    public function getStaticContent(string $demoMode, string $tag = null) : ?array
    {
        $staticContent = '';
        if ($demoMode === "true" && is_null($tag)) {
            $staticContent = file_get_contents(__DIR__ . $_ENV['STATIC_CONTENT'] . self::PUBLICATION . '.json');
        }

        if ($demoMode === "true" && isset($tag)) {
            $staticContent = file_get_contents(sprintf(__DIR__ . $_ENV['STATIC_CONTENT'] . '%s.json', $tag));
        }

        return json_decode($staticContent, true);
    }
}