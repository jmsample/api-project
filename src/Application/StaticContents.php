<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Application;


class StaticContents implements Contents{
	
	const FILES = "../resources/demo-responses/";


	public function getContents(string $request = 'thejournal'): Array
	{

		//testing for available files
		if($request === 'apple' || $request === 'google'){

			$contentStr = file_get_contents(self::FILES . $request . '.json');

		} else {

			//if there are no files that match the request, show the default one
			$contentStr = file_get_contents(self::FILES . 'thejournal.json');

		}

		//converting from json to array
		$articles = json_decode($contentStr, true);

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


} //end StaticContents