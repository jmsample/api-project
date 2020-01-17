<?php

namespace JournalMedia\Sample\Validator;

/**
 * Class PublicationValidator
 * @package JournalMedia\Sample\Validator
 */
class PublicationValidator
{
    // Allowed publications
    const PUBLICATIONS = [
        'thejournal',
        'thescore',
        'thedailyedge',
        'businessetc'
    ];

    /**
     * Very basic validator
     *
     * @param $publication
     * @return bool
     */
    public static function validate($publication)
    {
        if (empty($publication) || !is_string($publication)) {
            return false;
        }

        return in_array($publication, self::PUBLICATIONS);
    }
}