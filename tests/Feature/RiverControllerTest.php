<?php

namespace Feature;


use JournalMedia\Sample\Http\Controller\PublicationRiverController;
use JournalMedia\Sample\Http\Controller\TagRiverController;
use PHPUnit\Framework\TestCase;

class RiverControllerTest extends TestCase
{
    public function setUp()
    {
        $this->api_params=array(
            'url'=>'https://api.thejournal.ie/v3/sample/',
            'user'=>'codetest',
            'pass'=>'AQJl5jewY2lZkrJpiT1cCJkj1tLPn64R'
        );

        $this->demo_params=array(
            'path'=>'resources/demo-responses/',
            'defaultFileName'=>'thejournal.json'
        );
    }
    public function testHomePageWithApi()
    {
        $homeApi=new PublicationRiverController('API',$this->api_params);
        $response=$homeApi->getPublications();
        $this->assertIsArray($response);
        $this->assertEquals(10,count($response));
    }

    public function testSlugPageWithApi()
    {
        $homeApi=new TagRiverController('API',$this->api_params);
        $response=$homeApi->getPublications('google');
        $this->assertIsArray($response);
        $this->assertEquals(10,count($response));
    }

    public function testHomePageWithDemo()
    {
        $homeApi=new PublicationRiverController('STATIC',$this->demo_params);
        $response=$homeApi->getPublications();
        $this->assertIsArray($response);
        $this->assertEquals(6,count($response));
        $articleTitle=$response[0]['title'];
        $this->assertEquals("Las Vegas shooter named as 64-year-old Stephen Paddock", $articleTitle);

    }

    public function testSlugPageWithDemo()
    {
        $homeApi=new TagRiverController('STATIC',$this->demo_params);
        $response=$homeApi->getPublications('google');
        $this->assertIsArray($response);
        $this->assertEquals(10,count($response));
        $articleTitle=$response[0]['title'];
        $this->assertEquals("EU ministers are trying to make Facebook and Google pay more tax", $articleTitle);

    }
}
