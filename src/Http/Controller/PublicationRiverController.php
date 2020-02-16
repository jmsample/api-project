<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use JournalMedia\Sample\Repository\RiverFactory;


class PublicationRiverController extends RiverBaseController
{
    /**
     * Constructor
     */
    public function __construct($riverMode = null, $riverModeParams = [])
    {
        parent::setRiverMode($riverMode, $riverModeParams);
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $riverOfArticles = $this->getPublications();
        return $this->buildRiverResponse($riverOfArticles);
    }

    public function getPublications()
    {
        $riverRepository = RiverFactory::createRiverRepository($this->riverMode, $this->riverModeParams);
        return $riverRepository->getPublications();
    }

}
