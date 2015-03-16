<?php

namespace Mpwarfwk\Component;

class Bootstrap{

	protected $env;
	protected $debug;

	public function __construct($env = 'prod', $debug = false){
		$this->env 		= $env;
		$this->debug 	= $debug;
		echo "Boostraped"; 
	}

	public function execute(){
		echo " in ". $this->env . " environment - ";
		$Router 			= new Router();
		$ControllerUri 		= $Router->getRoute();
		$Controller 		= new $ControllerUri();

	}
}

