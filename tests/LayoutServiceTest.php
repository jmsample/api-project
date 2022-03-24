<?php


use PHPUnit\Framework\TestCase;

use JournalMedia\Sample\ApiProject\Services\LayoutService;
use JournalMedia\Sample\ApiProject\Repositories\River\JSONRiverRepository;

class LayoutServiceTest extends TestCase
{
    private $layoutService;
    private $JSONRepository;

    protected function setUp() : void{
        $this->layoutService = new LayoutService;
        $this->JSONRepository = new JSONRiverRepository;
    }

    /**
     * @covers \LayoutService::formatArticle
     */
    public function testShouldBeFormatted(){

        $river = $this->JSONRepository->getRiverByTag('layout');
        $result = $this->layoutService->formatRiver($river);

        $expected = '<article>
                <h3>This is the title for 3601026</h3>
                <p>This is the excerpt for 3601026</p>
                <figure>
                    <img src="http://c3.thejournal.ie/media/2017/09/facebook-stock-9-145x145.jpg">
                </figure>
            </article><article>
                <h3>This is the title for 99393</h3>
                <p>This is the excerpt for 99393</p>
                <figure>
                    <img src="http://c3.thejournal.ie/media/2022/09/facebook-stock-9-145x145.jpg">
                </figure>
            </article>';

        $this->assertEquals($expected, $result);
    }
}
