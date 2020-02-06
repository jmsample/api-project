<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use JournalMedia\Sample\Domain\River;
use JournalMedia\Sample\Domain\StreamFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

final class PublicationRiverController extends BaseController
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        // Load River
        $river = new River(StreamFactory::createStream());

        // Response
        return new HtmlResponse(
            sprintf("%s", $this->buildRiverResponse($river->getStream()->loadFromPublication()))
        );
    }
}
