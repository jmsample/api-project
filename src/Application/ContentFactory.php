<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Application;

use Dotenv\Dotenv;

class ContentFactory{

	private static $demo_mode;


	public function __construct(){

		$this->loadEnvironmentVariables();

		self::$demo_mode = $_ENV['DEMO_MODE'];

	}


	public static function createRiver(string $request = ""){

		//checks environment variable
		$demo = strtolower(self::$demo_mode);
		

		//the request is forwarded to the appropriate class depending on the environment variable
		if($demo === 'false' || $demo === '0' || $demo === 'off' || $demo === 'no'){
			
			$contentObj = new LiveContents; $content = $contentObj->getContents($request);
		
		} else {

			$contentObj = new StaticContents; $content = $contentObj->getContents($request);
		}

		return $content;

	}


	private function loadEnvironmentVariables(): void
    {
        $dotenv = Dotenv::create(__DIR__ . "/../../");
	$dotenv->load();
    }


} //end ContentFactory