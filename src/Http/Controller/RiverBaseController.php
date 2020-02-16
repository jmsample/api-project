<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use JournalMedia\Sample\Repository\RiverFactory;


class PublicationRiverController extends RiverBaseController
{

    public function __construct($riverMode = null)
    {
        parent::setRiverMode($riverMode);
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $riverOfArticles = $this->getPublications();
        return $this->buildRiverResponse($riverOfArticles);
    }

    public function getPublications()
    {
        $riverRepository = RiverFactory::createRiverRepository($this->riverMode);
        return $riverRepository->getPublications();
    }

}
