<?php

namespace JournalMedia\Sample\ApiProject\Services;

use JournalMedia\Sample\ApiProject\Services\HelperService;

class PublicationRiverService
{
    public function __construct(private HelperService $helperService)
    {
    }

    public function getFormatedArticles(): string
    {
        $formatedContent = "";
        if ($_ENV['DEMO_MODE'] === "true") {
            $content = file_get_contents('../resources/demo-responses/thejournal.json');
            $articles = json_decode($content, true);
            $formatedContent = $this->helperService->getFormatedArticles($articles);
        } else {
            $content = $this->helperService->callApi("{$_ENV['API_URL']}/thejournal");
            $jsonContent = json_decode($content, true);
            if (!empty($jsonContent)) {
                $formatedContent = $this->helperService->getFormatedArticles($jsonContent["response"]["articles"]);
            }
        }
        return $formatedContent;
    }
}
