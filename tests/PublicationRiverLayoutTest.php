<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use JournalMedia\Sample\ApiProject\Layout\River\PublicationRiverLayout;
use JournalMedia\Sample\ApiProject\Repository\River\LocalRiverRepository;

class PublicationRiverLayoutTest extends TestCase
{
    private PublicationRiverLayout $layout;
    private LocalRiverRepository $repo;

    protected function setUp() : void
    {
        $this->layout   = new PublicationRiverLayout();
        $this->repo     = new LocalRiverRepository();
    }

    /**
     * @covers \PublicationRiverLayout::layoutPublication()
     */
    public function testLayoutPublication() : void 
    {
        $data   = $this->repo->getPublication();
        $layout = $this->layout->layoutPublication( $data );

        $this->assertStringContainsString( "Publication", $layout );
    }
}