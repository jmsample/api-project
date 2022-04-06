<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use JournalMedia\Sample\ApiProject\Repository\River\RiverRepositoryInterface;
use JournalMedia\Sample\ApiProject\Layout\River\PublicationRiverLayout;

final class PublicationRiverController
{
    private RiverRepositoryInterface $repo;  
    private PublicationRiverLayout $layout;

    public function __construct( RiverRepositoryInterface $repo, PublicationRiverLayout $layout )
    {
        $this->repo     = $repo;
        $this->layout   = $layout;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $data = $this->repo->getPublication();
        return new HtmlResponse( $this->layout->layoutPublication( $data ) );
    }
}
