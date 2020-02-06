<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Domain;

/**
 * Class DemoStream
 */
final class DemoStream implements StreamInterface
{
    /**
     * Path for demo files
     *
     * @var string
     */
    private $path;

    /**
     * constructor
     */
    public function __construct(string $tag = '')
    {
        $this->path = __DIR__.'/../../resources/demo-responses';

        if (empty($tag)) {
            $this->stream = $this->loadFromPublication();
        } else {
            $this->stream = $this->loadFromTag($tag);
        }
    }

    /**
     * Get articles stream from publication endpoint
     *
     * @return string
     */
    public function loadFromPublication() : array
    {
        return json_decode(file_get_contents($this->path.'/thejournal.json'), true);
    }

    /**
     * Get articles stream for a tag
     *
     * @param string $tag
     * @return array
     */
    public function loadFromTag(string $tag) : array
    {
        return json_decode(file_get_contents($this->path.'/'.$tag.'.json'), true);
    }
}