<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use JournalMedia\Sample\ApiProject\Repositories\River\RiverRepositoryInterface;
use JournalMedia\Sample\ApiProject\Services\LayoutService;

final class TagRiverController
{
    public $riverRepository;
    public $layoutService;

    public function __construct(
        RiverRepositoryInterface $riverRepository,
        LayoutService $layoutService)
    {
        $this->riverRepository = $riverRepository;
        $this->layoutService = $layoutService;
    }

    public function __invoke(
        ServerRequestInterface $request,
        array $args
    ): ResponseInterface {
        return new HtmlResponse(
            //"Display the contents of the river for the tag '{$args['tag']}'"
            $this->layoutService->formatRiver($this->riverRepository->getRiverByTag($args['tag']))
        );
    }
}
