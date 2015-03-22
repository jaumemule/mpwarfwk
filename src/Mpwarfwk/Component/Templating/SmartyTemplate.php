<?php
namespace Mpwarfwk\Component\Templating;
use Smarty;

final class SmartyTemplate implements Templating{

	protected $view;

	public function __construct(){
		$this->view = new Smarty();
	}

	public function render($template, $vars = null){
		return $this->view->fetch($template);
	}
    
    public function assignVariables($vars){
    	foreach ($vars as $key => $value){
            $this->view->assign($key,$value);
        }
    }
}