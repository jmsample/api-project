<?php
namespace JournalMedia\Sample\Http\Controller;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class Controller
 * @package JournalMedia\Sample\Http\Controller
 */
class Controller
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem('./../view');
        $this->twig = new \Twig_Environment($loader);
    }

    /**
     * @param $url
     * @param $content
     * @return HtmlResponse
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render($url, $content)
    {
        return new HtmlResponse(
            sprintf($this->twig->render($url, $content))
        );
    }
}