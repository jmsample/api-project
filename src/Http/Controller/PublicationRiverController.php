<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use JournalMedia\Sample\ApiProject\Repositories\River\RiverRepositoryInterface;
use JournalMedia\Sample\ApiProject\Services\LayoutService;

final class PublicationRiverController
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

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse(
            $this->layoutService->formatRiver($this->riverRepository->getRiver())
        );
    }
}
