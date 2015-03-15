<?php

namespace Mpwarfwk\Component;

class Router{

	protected $uri;
	protected $controllerUri;
	protected $CONTROLLER_NAMESPACE = 'Controllers';

	public function __construct($uri){

		$specialChar = explode("/?", $uri);
		$this->uri = trim($specialChar[0], "/");
		
		//$this->uri = $specialChar[0];
		echo " routing to ".$this->uri; 

	}

	public function getRoute(){
		foreach (json_decode(file_get_contents('../src/Config/controllers.json'), true) as $uri => $value) {
			if (@$uri == $this->uri) {
				return $this->CONTROLLER_NAMESPACE."\\".$value["path"]."\\".$value["controller"];
			}
				//return "Controllers\\404";

		}
		return "404";
	}
}

