<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use JournalMedia\Sample\Factories\Configurations\PublicationRiverConfigurationFactory;
use JournalMedia\Sample\Services\HttpClient\HttpClient;
use JournalMedia\Sample\Services\RiversServer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class PublicationRiverController
 * @package JournalMedia\Sample\Http\Controller
 */
class PublicationRiverController extends Controller
{
    private $riversServer;

    /**
     * PublicationRiverController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
        $configurationFactory = new PublicationRiverConfigurationFactory();
        $configuration = $configurationFactory->create();
        $httpClient = new HttpClient();
        $this->riversServer = new RiversServer($httpClient, $configuration);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $rivers = $this->riversServer->load('thejournal');
        return $this->render('publication.html', ['title' => 'The Journal', 'rivers' => $rivers]);
    }
}
