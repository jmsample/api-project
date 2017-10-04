<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use JournalMedia\Sample\Classes\DataHandler;

class PublicationRiverController extends DataHandler
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
    	$data = (getenv('DEMO_MODE') === "true") ? $this->fetchFile() : $this->fetchAPI();

        ob_start();

        include("../src/View/index.php");

        $view_content = ob_get_contents();
        ob_end_clean();

        return new HtmlResponse(
        	$view_content
            // sprintf("Demo Mode: %s", getenv('DEMO_MODE') === "true" ? "ON" : "OFF")
        );
    }
}
