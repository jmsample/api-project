<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use JournalMedia\Sample\ApiProject\Layout\River\TagRiverLayout;
use JournalMedia\Sample\ApiProject\Repository\River\LocalRiverRepository;

class TagRiverLayoutTest extends TestCase
{
    private TagRiverLayout $layout;
    private LocalRiverRepository $repo;

    protected function setUp() : void
    {
        $this->layout   = new TagRiverLayout();
        $this->repo     = new LocalRiverRepository();
    }

    /**
     * @covers \TagRiverLayout::layoutTag() 
     */
    public function testLayoutTag() : void 
    {
        $tag    = "apple";
        $data   = $this->repo->getTag( $tag );
        $layout = $this->layout->layoutTag( $tag, $data );

        $this->assertStringContainsString( "Tag: {$tag}", $layout );
    }
}