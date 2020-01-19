<?php


namespace JournalMedia\Sample\Http\Controller;

use Twig\Environment;

/**
 * Class Controller is the base controller of the system.
 * @package JournalMedia\Sample\Http\Controller
 *
 * @author Gabriel Anhaia <anhaoa.gabriel@gmail.com>
 */
class Controller
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
     * @return string
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    protected function view(string $path, array $data = []): string
    {
        return $this->twig->render($path, $data);
    }
}