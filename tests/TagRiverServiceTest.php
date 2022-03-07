<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use JournalMedia\Sample\ApiProject\Services\TagRiverService;
use JournalMedia\Sample\ApiProject\Services\HelperService;

final class TagRiverServiceTest extends TestCase
{
    public function testCanGetArticlesByTag(): void
    {
        $_ENV["DEMO_MODE"]="false";
        $_ENV["API_URL"]="https://api.thejournal.ie/v3/sample/";
        
        $content = file_get_contents('tests/resources/jsontest.json');
        $jsonContent = json_decode($content, true);

        $helpService = $this->createStub(HelperService::class);
        $helpService->method('callApi')
             ->willReturn($content);

        $htmlContent = file_get_contents('tests/resources/htmltest.html');
        $helpService->method('getFormatedArticles')
             ->willReturn($htmlContent);


        $tagService = new TagRiverService($helpService);     
        $articleFormated = $tagService->getFormatedArticles("google");
        
        $this->assertStringContainsString("Google Ireland said they had no specifics regarding the measure", $articleFormated, "Looking for a especific article by tag");
    }

    public function testReturnNoArticlesByTag(): void
    {
        $_ENV["DEMO_MODE"]="false";
        $_ENV["API_URL"]="https://api.thejournal.ie/v3/sample/";

        $helpService = $this->createStub(HelperService::class);
        $helpService->method('callApi')
             ->willReturn("");

        $helpService->method('getFormatedArticles')
             ->willReturn("");

        $tagService = new TagRiverService($helpService);     
        $articleFormated = $tagService->getFormatedArticles("google");
        
        $this->assertEmpty($articleFormated, "Articles by tag return null");
    }
}
