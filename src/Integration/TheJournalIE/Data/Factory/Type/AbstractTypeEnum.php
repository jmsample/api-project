<?php


namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\Type;


use Eloquent\Enumeration\AbstractEnumeration;

/**
 * @method static MOCK()
 * @method static REQUESTER()
 */
class AbstractTypeEnum extends AbstractEnumeration
{
    const CACHE = 'CACHE';

    const REQUESTER = 'REQUESTER';

    const MOCK = 'MOCK';
}