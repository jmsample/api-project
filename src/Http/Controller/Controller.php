<?php


namespace JournalMedia\Sample\Http\Controller;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class Controller is the base controller of the system.
 * @package JournalMedia\Sample\Http\Controller
 *
 * @author Gabriel Anhaia <anhaoa.gabriel@gmail.com>
 */
abstract class Controller
{
    /** @var Environment $twig Template engine object. */
    private $twig;

    /**
     * Controller constructor.
     * @param Environment $environment
     */
    public function __construct(Environment $environment)
    {
        $this->twig = $environment;
    }

    /**
     * Method responsible for loading a view.
     *
     * @param string $path Path of the view to be loaded.
     * @param array $data Data to be sent to the view.
     * @return HtmlResponse
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    protected function view(string $path, array $data = []): HtmlResponse
    {
        return new HtmlResponse($this->twig->render($path, $data));
    }
}