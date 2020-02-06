<?php
declare(strict_types=1);

use JournalMedia\Sample\Domain\River;
use PHPUnit\Framework\TestCase;

class ApiRiverTest extends TestCase
{
    public function testFromPublication(): void
    {
        // Mock the StreamInterface
        $stream = \Mockery::mock('JournalMedia\Sample\Domain\StreamInterface');
        $stream->shouldReceive('loadFromPublication')->once()->andReturn([
            "title" => "Publication Title Article from Test",
            "excerpt" => "Publication Excerpt Article from Test",
            "images" => [
                "thumbnail" => [
                    "image" => "https://path.to.my/test/publication/image.png",
                    "height" => "25",
                    "width" => "25"
                ],
            ],
        ]);

        // River to be tested
        $river = new River($stream);
        
        // Is empty?
        $this->assertNotEmpty($river->getStream()->loadFromPublication());
    }

    public function testFromTag(): void
    {
        // Mock the StreamInterface
        $stream = \Mockery::mock('JournalMedia\Sample\Domain\StreamInterface');
        $stream->shouldReceive('loadFromTag')->once()->andReturn([
            "title" => "Tag Title Article from Test",
            "excerpt" => "Tag Excerpt Article from Test",
            "images" => [
                "thumbnail" => [
                    "image" => "https://path.to.my/test/tag/image.png",
                    "height" => "25",
                    "width" => "25"
                ],
            ],
        ]);

        // River to be tested
        $river = new River($stream);
        
        // Is empty?
        $this->assertNotEmpty($river->getStream()->loadFromTag('apple'));
    }
}