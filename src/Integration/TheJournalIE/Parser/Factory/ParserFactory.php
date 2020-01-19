<?php


namespace JournalMedia\Sample\Integration\TheJournalIE\Parser\Factory;

use JournalMedia\Sample\Integration\TheJournalIE\Parser\ArticleParser;

/**
 * Class ParserFactory
 * @package JournalMedia\Sample\Integration\TheJournalIE\Parser
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ParserFactory
{
    /**
     * Create the parser.
     *
     * @param ParserTypeEnum $type
     * @return ArticleParser
     */
    public function make(ParserTypeEnum $type)
    {
        switch ($type->value()) {
            case ParserTypeEnum::PARSER_ARTICLES:
                return new ArticleParser;
                break;
        }
    }
}