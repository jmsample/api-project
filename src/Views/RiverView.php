<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Views;

class RiverView
{
    public static $html;

    public function __construct($data)
    {
        $this::$html = $this->markUp($data);
    }

    public function markUp($data){
        $html = $this->markUpOpen();
        $html.="<div class='container'>";
        $html.= $this->header();
        $html.="<div class='row'>";
        if(count($data) > 0 ){
            $counter = 1;
            foreach($data as $item){
                $html.="<div class='col-sm-6'>";

                $html.="<div class='row'>";
                $html.="<div class='col-sm-4'>";
                $html.="<img src='".$item['image']."' class='img-thumbnail' />";
                $html.="</div>";
                $html.="<div class='col-sm-8'>";
                $html.="<h4>".$item['title']."</h4>";
                $html.="<p>".$item['excerpt']."</p>";
                $html.="</div>";
                $html.="</div>";
                $html.="</div>";
                if($counter % 2 == 0){
                    $html.="</div><div class='row'>";
                }
                $counter++;
            }
        } else {
            $html.="<div class='col-sm-12'>";
            $html.="<h2>Oops ! Something went wrong ! No articles found...</h2>";
            $html.="</div>";
        }
        $html.="</div>";
        $html.="</div>";
        $html.= $this->markUpClose();
        return $html;
    }

    private function header(){
        return "
            <div class='row'>
                <div class='col-sm-2'>
                    <h3>Demo</h3>
                </div>
                <div class='col-sm-10'>
                    <ul class='nav nav-pills' role='tablist'>
                        <li role='presentation'><a href='/'>Home</a></li>
                        <li role='presentation'><a href='/apple'>Apple</a></li>
                        <li role='presentation'><a href='/google'>Google</a></li>
                    </ul>
                </div>
            </div>
        ";
    }

    private function markUpOpen(){
        return "
            <!DOCTYPE html>
                <html>
                    <head>
                        <title>Title of the document</title>
                        <link rel='stylesheet' href='/css/bs.css' />
                    </head>
                    <body>
        ";
    }

    private function markUpClose(){
        return "
                </body>
            </html>
        ";
    }

}
