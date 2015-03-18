<?php
namespace Mpwarfw\Component;
interface Templating{
	public function render($template, $vars = null);
    public function assignVariables($vars);
}