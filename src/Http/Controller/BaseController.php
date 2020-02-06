<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

abstract class BaseController
{
    /**
     * Formats the response
     *
     * @param array $item
     * @return string
     */
    protected function buildRiverResponse(array $articles) : string
    {
        $response = '';
        foreach($articles as $article) {
            $image = $article["images"]["thumbnail"];
            
            $response .= '
                <img src="'.$image["image"].'" height="'.$image["height"].'" width="'.$image["width"].'" />
                <br/>'.$article["title"].'<br/>'.$article["excerpt"].'<hr/>
            ';
        }
        return $response;
    } 
}
