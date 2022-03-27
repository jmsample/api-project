<?php
declare(strict_types=1);

use JournalMedia\Sample\ApiProject\Service\RiverFileDataSource;
use PHPUnit\Framework\TestCase;

class RiverFileDataSourceTest extends TestCase
{
    const PUBLICATION_NAME = 'thejournal';
    const TAG_NAME = 'google';
    const RIVER_DEMO_FILES_RELATIVE_PATH = 'resources/demo-responses';

    /** @test */
    public function it_get_publication_articles()
    {
        $dataSource = new RiverFileDataSource(self::RIVER_DEMO_FILES_RELATIVE_PATH);
        $articles = $dataSource->getArticlesByPublication(self::PUBLICATION_NAME);
        $article = reset($articles);
        $this->assertArticleFields($article);
    }

    /** @test */
    public function it_get_tag_articles()
    {
        $dataSource = new RiverFileDataSource(self::RIVER_DEMO_FILES_RELATIVE_PATH);
        $articles = $dataSource->getArticlesByTag(self::TAG_NAME);
        $article = reset($articles);
        $this->assertArticleFields($article);
    }

    /**
     * @param mixed $article
     * @return void
     */
    private function assertArticleFields(mixed $article): void
    {
        $this->assertNotEmpty($article['title']);
        $this->assertNotEmpty($article['excerpt']);
        $this->assertNotEmpty($article['images']);
    }
}