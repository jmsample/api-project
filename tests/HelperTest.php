<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use JournalMedia\Sample\ApiProject\Services\HelperService;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class HelperTest extends TestCase
{
    public function testGetFormatedArticles(): void
    {
        $content = file_get_contents('tests/resources/jsontest.json');
        $jsonContent = json_decode($content, true);

        $httpService = $this->createStub(HttpClientInterface::class);
        $helperService = new HelperService($httpService);

        $articleFormated = $helperService->getFormatedArticles($jsonContent["response"]["articles"]);

        $this->assertStringContainsString("Here's What Happened Today: Thursday", $articleFormated, "Formating articles function working correcty");
    }
}
