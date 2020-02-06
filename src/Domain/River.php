<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Domain;

/**
 * Class River
 */
final class River
{
    /**
     * Stream
     *
     * @var StreamInterface
     */
    private $stream;

    public function __construct(StreamInterface $stream)
    {
        $this->stream = $stream; 
    }

    /**
     * Get stream
     */
    public function getStream()
    {
        return $this->stream;
    }
}