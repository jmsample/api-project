<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use GuzzleHttp\Client;
use JournalMedia\Sample\Http\Utils\Template;
use JournalMedia\Sample\Http\Utils\River;


class TagRiverController
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {

		$riverSource = new River();
    	$arg = preg_replace('/[^-a-zA-Z0-9_]/', '', $args['tag']);

    	if(getenv('DEMO_MODE') === "true")
    	{  		
    		$river = $riverSource->getLocalRiver($arg);						
		} else {
			$uri = "https://api.thejournal.ie/v3/sample/tag/" . $arg;
			$river = $riverSource->getRiver($uri);	
		}

		$template = new Template();
		echo $template->getTemplate()->render('index.html.twig', array('river' => $river, 
																	   'title' => 'Tag River: ' . $arg, 
																	   'demo'  => getenv('DEMO_MODE'))); 
		die();

        return new HtmlResponse(
            sprintf("Display the contents of the river for the tag '%s'", $args['tag'])
        );
    }
}
