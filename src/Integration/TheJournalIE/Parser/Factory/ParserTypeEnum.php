<?php


namespace JournalMedia\Sample\Integration\TheJournalIE\Parser\Factory;


use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Class ParserTypeEnum
 * @package JournalMedia\Sample\Integration\TheJournalIE\Parser\Factory
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ParserTypeEnum extends AbstractEnumeration
{
    /** @var string PARSER_ARTICLES Default parser for articles. */
    const PARSER_ARTICLES = 'PARSER_ARTICLES';
}