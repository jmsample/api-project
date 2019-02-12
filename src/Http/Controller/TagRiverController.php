<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use JournalMedia\Sample\Repository\RiverRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class TagRiverController
{
    protected $river;

    public function __construct(RiverRepositoryInterface $river)
    {
        $this->river = $river;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        return new JsonResponse(
            $this->river->getForTag($args['tag'])
        );
    }
}
