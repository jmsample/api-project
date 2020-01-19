<?php

namespace JournalMedia\Sample\Integration\TheJournalIE\Parser;

use JournalMedia\Sample\Integration\TheJournalIE\Entity\{
    ArticleEntity,
    Enum\ArticleTypeEnum,
    ImageEntity
};
use JournalMedia\Sample\Integration\GeneralContract\IParser;

/**
 * Class ArticleParser
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ArticleParser implements IParser
{
    /**
     * ArticleParser constructor.
     * @param mixed $rawData
     * @return array
     * @throws \Exception
     */
    public function parse($rawData)
    {
        $result = [];

        try {
            $rawData = json_decode($rawData, true);
        } catch (\Exception $exception) {
            throw new \Exception('Invalid format data.');
        }

        if (!isset($rawData['response']['articles'])) {
            throw new \Exception('Invalid format data.');
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