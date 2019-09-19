<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Application;

use GuzzleHttp\Client;

class LiveContents implements Contents{
	
	const API = 'https://api.thejournal.ie/v3/sample/';
	const USR = 'codetest';
	const PWD = 'AQJl5jewY2lZkrJpiT1cCJkj1tLPn64R';
	
	
	public function getContents(string $request = 'thejournal'): Array
	{

		//get data from Guzzle
		$client = new Client();

		//testing for valid values
		if ($request !== 'thejournal' && $request !== 'thescore' && $request !== 'thedailyedge' && $request !== 'businessetc') {
			
			$request = 'tag/' . $request;

		} 

		//getting data from the API
		$response = $client->request('GET', self::API . $request, ['auth' => [self::USR, self::PWD]]);

		
		//casting to string to use as json
		$contentStr = (string) $response->getBody();

		//converting from json to array 
		$contentArr = json_decode($contentStr, true);

		//filtering the content available in 'articles' array
		$articles = $contentArr['response']['articles'];

		$river = array();

		//filtering needed data from the 'articles' array
		foreach ($articles as $key => $value) {

			if($articles[$key]['type'] == 'post'){
				
				$river[$key]['title'] = $articles[$key]['title'];
				$river[$key]['excerpt'] = $articles[$key]['excerpt'];
				$river[$key]['image'] = $articles[$key]['images']['river_0'];

			}

		} //end foreach

		return $river;

	} //end getContents()


} //end LiveContents