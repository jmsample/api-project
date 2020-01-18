<?php

namespace JournalMedia\Sample\Entity\Enum;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Class ArticleTypeEnum with the types of the articles available.
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ArticleTypeEnum extends AbstractEnumeration
{
    /** @var string POST Type of post for articles.  */
    const POST = 'post';
}