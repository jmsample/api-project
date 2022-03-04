<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use JournalMedia\Sample\ApiProject\Services\PublicationRiverService;
use JournalMedia\Sample\ApiProject\Services\HelperService;

final class PublicationRiverTest extends TestCase
{
    public function testCanGetArticles(): void
    {
        $_ENV["DEMO_MODE"] = "false";
        $_ENV["API_URL"] = "https://api.thejournal.ie/v3/sample/";

        $content = file_get_contents('tests/resources/jsontest.json');
        $jsonContent = json_decode($content, true);

        $helpService = $this->createStub(HelperService::class);
        $helpService->method('callApi')
            ->willReturn($content);

        $htmlContent = file_get_contents('tests/resources/htmltest.html');
        $helpService->method('getFormatedArticles')
            ->willReturn($htmlContent);


        $publicationRiverService = new PublicationRiverService($helpService);
        $articleFormated = $publicationRiverService->getFormatedArticles();

        $this->assertStringContainsString("Google Ireland said they had no specifics regarding the measure", $articleFormated, "Looking for a especific article");
    }

    public function testReturnNoArticles(): void
    {
        $_ENV["DEMO_MODE"] = "false";
        $_ENV["API_URL"] = "https://api.thejournal.ie/v3/sample/";

        $helpService = $this->createStub(HelperService::class);
        $helpService->method('callApi')
            ->willReturn("");

        $helpService->method('getFormatedArticles')
            ->willReturn("");

        $publicationRiverService = new PublicationRiverService($helpService);
        $articleFormated = $publicationRiverService->getFormatedArticles();

        $this->assertEmpty($articleFormated, "Articles return null");
    }
}
