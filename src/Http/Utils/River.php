<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Utils;
 
use GuzzleHttp\Client;

class River
{
	var $river = []; 
    var $localRiver = []; 

    public function getRiver($uri)
    {
    	$client = new Client();        
        $response = $client->request('GET', $uri, ['auth' => ['sample', 'eferw5wr335£65']]);
        $body = $response->getBody();
        $jsonBody = json_decode((string) $body);
        $river = $jsonBody->response->articles; 
        return $river;
    }

    public function getLocalRiver($arg)
    {
        $localRiver = []; 
        $filename = __DIR__."/../../../resources/demo-responses/" . $arg . ".json";
        if (file_exists($filename)){
            $localRiver = json_decode(file_get_contents($filename));
        }
        return $localRiver;
    }
}
