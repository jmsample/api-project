<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse; 
use GuzzleHttp\Client;
use JournalMedia\Sample\Http\Utils\Template;
use JournalMedia\Sample\Http\Utils\River;

class PublicationRiverController
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
    	$riverSource = new River();

    	if(getenv('DEMO_MODE') === "true")
    	{
    		$river = $riverSource->getLocalRiver("thejournal");			
		} else {
			$uri = "https://api.thejournal.ie/v3/sample/thejournal";
			$river = $riverSource->getRiver($uri);
		}

		$template = new Template();
		echo $template->getTemplate()->render('index.html.twig', array('river' => $river, 
																	   'title' => 'Home Page River', 
																	   'demo'  => getenv('DEMO_MODE'))); 
		die();
    	
        return new HtmlResponse( 
            sprintf("Demo Mode: %s", getenv('DEMO_MODE') === "true" ? "ON" : "OFF")            
        );
    }
}
