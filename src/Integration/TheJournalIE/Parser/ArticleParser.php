<?php

namespace JournalMedia\Sample\Integration\TheJournalIE\Parser;

use JournalMedia\Sample\Integration\TheJournalIE\Entity\{
    ArticleEntity,
    Enum\ArticleTypeEnum,
    ImageEntity
};

/**
 * Class ArticleParser
 */
class ArticleParser
{
    /**
     * ArticleParser constructor.
     * @param mixed $rawData
     * @return array
     */
    public function parse($rawData)
    {
        $result = [];

        try {
            $rawData = json_decode($rawData, true);
        } catch (\Exception $exception) {
            // TODO: Log here invalid data.
            return $result;
        }

        if (!isset($rawData['response']['articles'])) {
            // TODO: Log here invalid data.
            return $result;
        }

        foreach ($rawData['response']['articles'] as $article) {
            if ($article['type'] !== ArticleTypeEnum::POST) {
                continue;
            }

            $articleEntity = new ArticleEntity();
            $articleEntity->setTitle($article['title'])
                ->setExcerpt($article['excerpt'])
                ->setType(ArticleTypeEnum::memberByValue($article['type']));

            if (!isset($article['images'])) {
                continue;
            }

            foreach ($article['images'] as $imageName => $image) {
                $url = $image['image'];
                $width = $image['width'];
                $height = $image['height'];

                if (empty($url)) {
                    continue;
                }

                $articleEntity->addImage(
                    (new ImageEntity($imageName, $url, $width, $height))
                );
            }

            $result[] = $articleEntity;
        }

        return $result;
    }
}