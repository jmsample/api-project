<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use JournalMedia\Sample\Repository\RiverFactory;

class TagRiverController extends RiverBaseController
{
    public function __construct($riverMode = null)
    {
        parent::setRiverMode($riverMode);
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args
    ): ResponseInterface
    {
        $path = $request->getUri()->getPath();
        $riverOfArticles = $this->getPublications($path);
        return $this->buildRiverResponse($riverOfArticles);
    }

    public function getPublications($path)
    {

        $slug = substr($path, 1);
        $riverRepository = RiverFactory::createRiverRepository($this->riverMode);
        return $riverRepository->getPublications($slug);
    }
}
