<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Classes;

abstract class DataHandler
{
    private $api_url = "http://api.thejournal.ie/v3/sample/";
    private $username = "sample";
    private $password = "eferw5wr335£65";
    private $tag = "";

    private function _processJSON( $articles ): array
    {
        $return_data = array();

        foreach($articles as $article):
            $title = (@$article->title)?$article->title:"";
            $excerpt = (@$article->excerpt)?$article->excerpt:"";
            $type = (@$article->type)?$article->type:"";

            $image = (@$article->images)?$article->images->thumbnail->image:"";

            if($type === "post"):
                $return_data[] = array(
                    "title" => $title,
                    "excerpt" => $excerpt,
                    "image" => $image
                );
            endif;
        endforeach;

        return $return_data;
    }

    public function setTag($tag): string
    {
        return $this->tag = $tag;
    }

    public function fetchAPI(): array
    {
        try{
            $curl_url = ($this->tag) ? $this->api_url . "tag/" . $this->tag : $this->api_url . "thejournal/";

            $process = curl_init($curl_url);
            curl_setopt($process, CURLOPT_USERPWD, $this->username . ":" . $this->password);
            curl_setopt($process, CURLOPT_TIMEOUT, 30);
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            $return = curl_exec($process);
            curl_close($process);

            if($return):
                $json_data = json_decode($return);

                if(@$json_data->response->articles && count($json_data->response->articles) > 0):
                        return $this->_processJSON( $json_data->response->articles );
                else:
                        return array();
                endif;
            endif;
        }catch(Exception $e){}

        return array();
    }

    public function fetchFile(): array
    {
        // Need a better way to get the base URL ./ or ../ won't work for both prod and tests - STev
        $file_location = "C:/xampp/htdocs/thejournal/resources/demo-responses/";
        $file_location .= ($this->tag) ? $this->tag.".json" : "thejournal.json";
        try{
            if( file_exists($file_location) ):
                $json_data = file_get_contents($file_location);

                return $this->_processJSON( json_decode($json_data) );
            else:
                return array();
            endif;
        }catch(Exception $e){}

        return array();
    }
}