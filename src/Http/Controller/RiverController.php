<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use JournalMedia\Sample\Application\DataProvider;
use JournalMedia\Sample\Views\RiverView;

class RiverController
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        return new HtmlResponse((new RiverView($this->getData($args['tag'])))::$html);
    }

    public function getData($tag)
    {
        return $this->filterData((new DataProvider())->getData($tag));
    }

    private function filterData($arr){
        $data = [];
        foreach($arr as $item){
            if($item['type'] != 'post'){ // drop other types
                continue;
            }
            $item = array(
                "title"=>$item['title'],
                "excerpt"=>$item['excerpt'],
                "image"=>$item['images']['listings_6']['image']
            );
            $data[]=$item;
        }
        return $data;
    }
}
