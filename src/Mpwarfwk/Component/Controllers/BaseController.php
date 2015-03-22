<?php

namespace Mpwarfwk\Component\Controllers;
use Mpwarfwk\Component\Request\Request;
use Mpwarfwk\Component\Container\Container;

abstract class BaseController{

	public $container;

	public function __construct(){
        $this->container = new Container();

	}
}

