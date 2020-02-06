<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Domain;

/**
 * Class StreamFactory
 */
class StreamFactory
{
    /**
     * Creates an instance of the right Stream depending of source of data
     *
     * @param string $mode
     * @return StreamInterface
     * @throws Exception
     */
    public static function createStream() : StreamInterface
    {
        if (getenv('DEMO_MODE') === "true") {
            return new DemoStream();
        }
        return new ApiStream();
    }
}