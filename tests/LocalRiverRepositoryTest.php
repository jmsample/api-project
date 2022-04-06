<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use JournalMedia\Sample\ApiProject\Repository\River\LocalRiverRepository;

class LocalRiverRepositoryTest extends TestCase
{
    private LocalRiverRepository $repo;

    protected function setUp() : void
    {
        $this->repo = new LocalRiverRepository();
    }

    /**
     * @covers \LocalRiverRepository::getPublication()
     */ 
    public function testGetPublicationShouldGetResults() : void
    {
        $data = $this->repo->getPublication();

        $this->assertIsArray( $data );
        $this->assertEquals( 3625527, $data[1]->id );
    }

    /**
     * @covers \LocalRiverRepository::getTag()
     */ 
    public function testGetTagShouldGetResults() : void
    {
        $data = $this->repo->getTag( "apple" );

        $this->assertIsArray( $data );
        $this->assertEquals( 3594899, $data[2]->id );
    }
}
