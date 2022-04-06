<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use JournalMedia\Sample\ApiProject\Repository\River\RiverRepositoryInterface;
use JournalMedia\Sample\ApiProject\Layout\River\TagRiverLayout;

final class TagRiverController
{
    private RiverRepositoryInterface $repo; 
    private TagRiverLayout $layout;

    public function __construct( RiverRepositoryInterface $repo, TagRiverLayout $layout )
    {
        $this->repo     = $repo;
        $this->layout   = $layout;
    }

    public function __invoke( ServerRequestInterface $request, array $args ): ResponseInterface 
    {
        $tag  = $args["tag"];
        $data = $this->repo->getTag( $tag  );
        
        return new HtmlResponse( $this->layout->layoutTag( $tag, $data ) );
    }
}
