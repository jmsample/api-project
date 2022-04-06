<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use JournalMedia\Sample\ApiProject\Repository\River\RemoteRiverRepository;

class RemoteRiverRepositoryTest extends TestCase
{
    private RemoteRiverRepository $repo;

    protected function setUp() : void
    {
        $this->repo = new RemoteRiverRepository();
    }

    /** 
     * @covers \RemoteRiverRepository::getPublication 
    */
    public function testGetPublicationShouldGetResults() : void
    {
        $data = $this->repo->getPublication();

        $this->assertIsArray( $data );
        $this->assertIsString( $data[0]->excerpt );
    }

    /**
     * @covers \RemoteRiverRepository::getTag 
     */
    public function testGetTagShouldGetResults()
    {
        $data = $this->repo->getTag( "apple" );

        $this->assertIsArray( $data );
        $this->assertIsString( $data[0]->excerpt );
    }
}
