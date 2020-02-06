<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Domain;

/**
 * Interface StreamInterface
 */
interface StreamInterface
{
    /**
     * Get articles stream from publication endpoint
     *
     * @param string $publication
     * @return array
     */
    public function loadFromPublication() : array;

    /**
     * Get articles stream for a tag
     *
     * @param string $tag
     * @return array
     */
    public function loadFromTag(string $tag) : array;
}
