<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Repository\River;

/**
 * Implementation of RiverRepositoryInterface for JSon files
 */
final class LocalRiverRepository implements RiverRepositoryInterface 
{
    public function getPublication() : array | null
    {
        return $this->getData( $_ENV['DEMO_PUBL'] );
    }
    
    public function getTag( string $tag ) : array | null
    {
        return $this->getData( $tag );
    }

    private function getData( string $fileName ) : array | null
    {
        $path     = $_ENV['DEMO_PATH'];
        $filePath = "{$path}/{$fileName}.json";

        if( file_exists( $filePath ) )
            return json_decode( file_get_contents( $filePath ) );

        return null;
    }
}
