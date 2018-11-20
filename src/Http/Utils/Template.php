<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Utils;
 
class Template
{
	var $twig; 
	var $loader;

    public function getTemplate()
    {
    	require_once __DIR__.'/../../../vendor/autoload.php';
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../Resources/views');
        $twig = new \Twig_Environment($loader, array('debug' => true));
        $twig->addExtension(new \Twig_Extension_Debug());
        return $twig;
    }
}
