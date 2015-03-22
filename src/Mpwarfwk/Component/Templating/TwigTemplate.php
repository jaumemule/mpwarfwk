<?php
namespace Mpwarfwk\Component\Templating;

use Twig_Environment;
use Twig_Loader_Filesystem;

final class TwigTemplate implements Templating {
    private $twig;
    public function __construct() {
    
        $loader = new Twig_Loader_Filesystem('../src/Templates');
        $this->twig = new Twig_Environment($loader, array(
            'cache' => false //'../src/Templates/cache'
        ));
    
    }
    public function render( $template, $vars = null ) {
        $template = $this->twig->loadTemplate( $template );
        return $template->render( $vars );
    }
}