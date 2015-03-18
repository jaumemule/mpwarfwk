<?php
namespace Mpwarfw\Component;
use Smarty;

final class SmartyTemplate implements Templating{

	protected $view;
	
	public function __contruct(){
		$this->view = new Smarty();
	}

	public function render($template, $vars = null){
		return $this->view->fetch($template);
	}
    
    public function assignVariables($vars){
    	foreach ($variables as $key => $value){
            $this->view->assign($key,$value);
        }
    }
}