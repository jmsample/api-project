<?php

namespace JournalMedia\Sample\Http\Controller;

use Zend\Diactoros\Response\HtmlResponse;
use JournalMedia\Sample\Repository\ArticleRepository;
use JournalMedia\Sample\Helpers\TemplateHelper;

class RiverBaseController
{

    protected $riverMode;
    protected $riverModeParams;

    public function setRiverMode($riverMode = null, $riverModeParams = [])
    {
        if (empty($riverMode)) {
            $this->riverMode = getenv('DEMO_MODE') === "true" ? "STATIC" : "API";
        } else {
            $this->riverMode = $riverMode;
        }
        $this->riverModeParams = $riverModeParams;
    }

    public function buildRiverResponse(array $riverOfArticles): HtmlResponse
    {
        $articleBlock = file_get_contents("../resources/views/riverBlock.html");
        $response = '';
        $articleRepo = new ArticleRepository();

        foreach ($riverOfArticles as $article) {
            if ($article['type'] == 'post') {
                $articleData = $articleRepo->transformArticleData($article);
                $response .= TemplateHelper::renderTemplate($articleBlock, $articleData);
            }
        }
        return $response = new HtmlResponse($response);
    }


}