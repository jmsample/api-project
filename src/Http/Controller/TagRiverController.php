<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use JournalMedia\Sample\Factories\Configurations\TagRiverConfigurationFactory;
use JournalMedia\Sample\Services\HttpClient\HttpClient;
use JournalMedia\Sample\Services\RiversServer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class TagRiverController
 * @package JournalMedia\Sample\Http\Controller
 */
class TagRiverController extends Controller
{
    private $riversServer;

    /**
     * TagRiverController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
        $configurationFactory = new TagRiverConfigurationFactory();
        $configuration = $configurationFactory->create();
        $httpClient = new HttpClient();
        $this->riversServer = new RiversServer($httpClient, $configuration);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $rivers = $this->riversServer->load($args['tag']);
        return $this->render('tag.html', ['title' => $args['tag'], 'rivers' => $rivers]);
    }
}
