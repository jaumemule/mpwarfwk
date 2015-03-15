<?php

namespace Mpwarfwk\Component;

class Bootstrap{

	protected $env;
	protected $debug;

	public function __construct($env, $debug){
		$this->env 		= $env;
		$this->debug 	= $debug;
		echo "Boostraped"; 
	}

	public function execute($uri){
		echo " in ". $this->env . " environment - ";
		$Router 			= new Router($uri);
		$ControllerUri 		= $Router->getRoute();

		$data 				= new Request();
		$requestedElements	= $data->getRequested();

		$Controller 		= new $ControllerUri($requestedElements);
		$Controller->build();

	}
}

