<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use JournalMedia\Sample\Repository\RiverFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class TagRiverController extends RiverBaseController
{
    /**
     * Constructor
     */
    public function __construct($riverMode = null, $riverModeParams = [])
    {
        parent::setRiverMode($riverMode, $riverModeParams);
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface
    {
        $path = $request->getUri()->getPath();
        $slug = substr($path, 1);
        $riverOfArticles = $this->getPublications($slug);
        return $this->buildRiverResponse($riverOfArticles);
    }

    public function getPublications($slug)
    {
        $riverRepository = RiverFactory::createRiverRepository($this->riverMode, $this->riverModeParams);
        return $riverRepository->getPublications($slug);
    }
}
