<?php

namespace JournalMedia\Sample\ApiProject\Services;

use JournalMedia\Sample\ApiProject\Services\HelperService;

class TagRiverService
{
    public function __construct(private HelperService $helperService)
    {
    }

    public function getFormatedArticles($tag)
    {
        $formatedContent = "";
        if ($_ENV['DEMO_MODE'] === "true") {
            if (!file_exists("../resources/demo-responses/{$tag}.json")) {
                return "Invalid slug";
            }

            $content = file_get_contents("../resources/demo-responses/{$tag}.json");
            $articles = json_decode($content, true);
            $formatedContent = $this->helperService->getFormatedArticles($articles);
        } else {
            $content = $this->helperService->callApi("{$_ENV['API_URL']}/tag/{$tag}");
            $jsonContent = json_decode($content, true);
            if (!empty($jsonContent)) {
                $formatedContent = $this->helperService->getFormatedArticles($jsonContent["response"]["articles"]);
            }
        }
        return $formatedContent;
    }
}
