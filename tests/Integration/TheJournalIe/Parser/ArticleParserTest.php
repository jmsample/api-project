<?php


namespace Tests\Integration\TheJournalIe\Parser;


use JournalMedia\Sample\Integration\TheJournalIE\Entity\ArticleEntity;
use JournalMedia\Sample\Integration\TheJournalIE\Entity\Enum\ArticleTypeEnum;
use JournalMedia\Sample\Integration\TheJournalIE\Entity\ImageEntity;
use JournalMedia\Sample\Integration\TheJournalIE\Parser\ArticleParser;
use Tests\TestCase;

/**
 * Class ArticleParserTest
 * @package Tests\Integration\TheJournalIe\Parser
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ArticleParserTest extends TestCase
{
    /**
     * Test error trying to parse a invalid raw data.
     *
     * @dataProvider dataProviderErrorParseInvalidFormatData
     *
     * @throws \Exception
     */
    public function testErrorParseArticleInvalidFormat()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid format data.');

        $rawData = '{';

        $parser = new ArticleParser;
        $parser->parse($rawData);
    }

    /**
     * Return data for the test {@see testErrorParseArticleInvalidFormat}
     */
    public function dataProviderErrorParseInvalidFormatData()
    {
        return [
            [
                '{'
            ],
            [
                '{"aaa"}'
            ],
            [
                '{"response": {}}'
            ]
        ];
    }

    /**
     * Test success parsing article.
     *
     * TODO: Improve this test with dataProvider and remove JSON at the code.
     */
    public function testSuccessParseArticle()
    {
        $rawData = '
             {
              "response": {
                "articles": [
                  {
                    "title": "Las Vegas shooter named as 64-year-old Stephen Paddock",
                    "excerpt": "He was shot dead by police. ",
                    "type": "post",
                    "images": {
                      "medium": {
                        "image": "http://c3.thejournal.ie/media/2017/10/las-vegas-shooting-6-145x145.jpg",
                        "width": 145,
                        "height": 146
                      },
                      "test-ignore": {
                        "image": "",
                        "width": 296,
                        "height": 194
                      },
                      "large": {
                        "image": "http://c3.thejournal.ie/media/2017/10/las-vegas-shooting-6-630x413.jpg",
                        "width": 630,
                        "height": 413
                      }
                    }
                  },
                  {
                    "title": "TEST ANOTHER TYPE",
                    "excerpt": "TEST",
                    "type": "ANOTHER_TYPE",
                    "images": {
                      "thumbnail": {
                        "image": "http://c3.thejournal.ie/media/2017/10/las-vegas-shooting-6-145x145.jpg",
                        "width": 145,
                        "height": 145
                      }
                    }
                  }
                ]
              }
            }       
        ';

        $parser = new ArticleParser();
        $parsedData = $parser->parse($rawData);

        $imageParsedData1 = new ImageEntity(
            'medium',
            'http://c3.thejournal.ie/media/2017/10/las-vegas-shooting-6-145x145.jpg',
            145,
            146
        );

        $imageParsedData2 = new ImageEntity(
            'large',
            'http://c3.thejournal.ie/media/2017/10/las-vegas-shooting-6-630x413.jpg',
            630,
            413
        );

        $expectedParsedData = new ArticleEntity;
        $expectedParsedData->setType(ArticleTypeEnum::POST())
            ->setExcerpt('He was shot dead by police. ')
            ->setTitle('Las Vegas shooter named as 64-year-old Stephen Paddock')
            ->setImages([$imageParsedData1, $imageParsedData2]);

        $this->assertEquals([$expectedParsedData], $parsedData);
    }
}