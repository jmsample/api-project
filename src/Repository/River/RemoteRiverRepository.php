<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Repository\River;

/**
 * Implementation of RiverRepositoryInterface for API calls
 */
final class RemoteRiverRepository implements RiverRepositoryInterface 
{
    public function getPublication() : array | null
    {
        return $this->getData( "sample/" );
    }
    
    public function getTag( string $tag ) : array | null
    {
        return $this->getData( "sample/tag/{$tag}" );
    }

    private function getData( string $uri ) : array | null
    {
        $user    = $_ENV["API_USER"];
        $pass    = $_ENV["API_PASS"];
        $baseURL = $_ENV["API_URL"];
        $url     = "{$baseURL}{$uri}"; 
        $curl    = curl_init();
        $options = array
        (
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_ENCODING        => "",
            CURLOPT_MAXREDIRS       => 10,
            CURLOPT_TIMEOUT         => 30,
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_FRESH_CONNECT   => 1,
            CURLOPT_FORBID_REUSE    => 1,
            CURLOPT_CUSTOMREQUEST   => "GET",            
            CURLOPT_URL             => $url,
            CURLOPT_USERPWD         => "{$user}:{$pass}"
        );

        curl_setopt_array( $curl, $options );
        
        $result = curl_exec( $curl );
        
        curl_close( $curl );

        if( $result !== false )
        {
            $json = json_decode( $result );
    
            if( !empty( $json ) && $json->status ) 
                return $json->response->articles;
        }
        return null;
    }
}
