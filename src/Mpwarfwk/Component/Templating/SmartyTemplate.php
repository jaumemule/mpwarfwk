<?php
namespace Mpwarfwk\Component\Templating;
use Smarty;

final class SmartyTemplate implements Templating{

	protected $view;

	public function __construct(){
		$this->view = new Smarty();
		$this->view->caching = 0;
	}

	public function render($template, $vars = null){
    	foreach ($vars as $key => $value){
            $this->view->assign($key,$value);
        }
		return $this->view->fetch($template);
	}
}