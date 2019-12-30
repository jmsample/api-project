<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Views;

Class RiverView
{
    public $HTML;

    function __construct($articles) 
    {
        $this->build($articles);
    }

    function build($articles) 
    {
        $this->HTML = <<<EOF
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> List of Articles </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    {$this->buildArticleList($articles)}
    </div>
</body>
</html>
EOF;
    }

    private function buildArticleList($articleList) {
        $output = '';
        foreach ($articleList as $article) {
            $output .= <<<EOF
    <div class="row mb-5 card p-2 box-shadow">
        <h2 class="col-12 mb-3">{$article->getTitle()}</h2>
        <p class="col-12">
        <img src="{$article->getImage()}" class="img-thumbnail float-left mr-4">
        {$article->getExcerpt()}</p>
    </div>
EOF;
        }
        if ($output === '') {
            $output = "No Articles found";
        }
        return $output;
    }
}