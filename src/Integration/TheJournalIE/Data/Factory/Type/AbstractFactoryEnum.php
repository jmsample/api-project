<?php


namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\Type;


use Eloquent\Enumeration\AbstractEnumeration;

/**
 * @method static LIST_ARTICLES_BY_TAG()
 * @method static LIST_ARTICLES()
 */
class AbstractFactoryEnum extends AbstractEnumeration
{
    const LIST_ARTICLES = 'LIST_ARTICLES';

    const LIST_ARTICLES_BY_TAG = 'LIST_ARTICLES_BY_TAG';
}