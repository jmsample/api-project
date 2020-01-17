<?php

namespace JournalMedia\Sample\Validator;

/**
 * Class TagValidator
 * @package JournalMedia\Sample\Validator
 */
class TagValidator
{
    // Allowed tags
    const TAGS = [
        'google',
        'apple',
        'early-adopters'
    ];

    /**
     * Very basic validator
     *
     * @param $publication
     * @return bool
     */
    public static function validate($tag)
    {
        if (empty($tag) || !is_string($tag)) {
            return false;
        }

        return in_array($tag, self::TAGS);
    }
}