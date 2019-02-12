<?php

namespace JournalMedia\Sample\Factory;

use JournalMedia\Sample\Model\Article;

class RiverFactory
{
    public static function fromSerializedArticles(array $serializedArticles)
    {
        $rivers = [];

        foreach ($serializedArticles as $serializedArticle) {
            $rivers[] = self::getArticleFromSerializedArticle($serializedArticle);
        }

        return $rivers;
    }

    public static function getArticleFromSerializedArticle(\stdClass $serializedArticle): Article {
        $river = new Article();

        if (isset($serializedArticle->title)) {
            $river->setTitle($serializedArticle->title);
        }

        if (isset($serializedArticle->excerpt)) {
            $river->setExcerpt($serializedArticle->excerpt);
        }

        if (isset($serializedArticle->images)) {
            $river->setImages($serializedArticle->images);
        }

        if (isset($serializedArticle->type)) {
            $river->setType($serializedArticle->type);
        }

        return $river;
    }
}
