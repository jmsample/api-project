<?php

use PHPUnit\Framework\TestCase;

class RiverFactoryTest extends TestCase
{
    const ARTICLE_TITLE = 'EU ministers are trying to make Facebook and Google pay more tax';
    const ARTICLE_EXCERPT = 'At least 10 ministers have called for it.';
    const ARTICLE_TYPE = 'post';

    public function testIfSerializedArticleIsNotComplete()
    {
        $article = \JournalMedia\Sample\Factory\RiverFactory::getArticleFromSerializedArticle(new \StdClass);

        $this->assertEquals(null, $article->getTitle());
        $this->assertEquals(null, $article->getExcerpt());
        $this->assertEquals(null, $article->getImages());
        $this->assertEquals(null, $article->getType());
    }

    public function testIfSerializedArticleIsComplete()
    {
        $images = json_decode(json_encode([
            'larger' => json_decode(json_encode([
                'image' => 'http://c3.thejournal.ie/media/2017/09/facebook-stock-9-230x150.jpg',
                'width' => 230,
                'height' => 150
            ]))
        ]));

        $completeArticle = json_decode(json_encode([
            'title' => self::ARTICLE_TITLE,
            'excerpt' => self::ARTICLE_EXCERPT,
            'images' => $images,
            'type' => self::ARTICLE_TYPE
        ]));


        $article = \JournalMedia\Sample\Factory\RiverFactory::getArticleFromSerializedArticle($completeArticle);

        $this->assertEquals(self::ARTICLE_TITLE, $article->getTitle());
        $this->assertEquals(self::ARTICLE_EXCERPT, $article->getExcerpt());
        $this->assertEquals($images, $article->getImages());
        $this->assertEquals(self::ARTICLE_TYPE, $article->getType());

    }

    public function testIfRiverIsComplete()
    {
        $serializedRiver = [
            self::getSerializedArticle(),
            self::getSerializedArticle(),
            self::getSerializedArticle(),
            self::getSerializedArticle(),
        ];

        $river = \JournalMedia\Sample\Factory\RiverFactory::fromSerializedArticles($serializedRiver);

        $this->assertEquals(4, count($river));
    }

    private static function getSerializedArticle() {
        $images = json_decode(json_encode([
            'larger' => json_decode(json_encode([
                'image' => 'http://c3.thejournal.ie/media/2017/09/facebook-stock-9-230x150.jpg',
                'width' => 230,
                'height' => 150
            ]))
        ]));

        return json_decode(json_encode([
            'title' => self::ARTICLE_TITLE,
            'excerpt' => self::ARTICLE_EXCERPT,
            'images' => $images,
            'type' => self::ARTICLE_TYPE
        ]));
    }
}
