<?php

use JournalMedia\Sample\Http\Controller\TagRiverController;

class TagTest extends PHPUnit_Framework_TestCase {

	public function testTagFetchAPI(){
		$indexController = new TagRiverController();
		$indexController->setTag("google");

		$this->assertTrue( is_array($indexController->fetchAPI()) );

		$indexController2 = new TagRiverController();
		$indexController2->setTag("microsoft");

		$this->assertTrue( is_array($indexController2->fetchAPI()) );
	}

	public function testTagFetchFile(){
		$indexController = new TagRiverController();
		$indexController->setTag("google");

		$this->assertTrue( is_array($indexController->fetchFile()) );

		$indexController2 = new TagRiverController();
		$indexController2->setTag("microsoft");

		$this->assertTrue( is_array($indexController2->fetchFile()) );
	}
}