<?php

namespace Mpwarfwk\Component;

class Router{

	protected $uri;
	protected $controllerUri;
	const  	  CONTROLLER_NAMESPACE = 'Controllers';

	public function __construct(Request $request){


		$specialChar = explode("/?", $request->_server->REQUEST_URI);
		$this->uri = trim($specialChar[0], "/");
		
		echo " routing to ".$this->uri; 

	}

	public function getRoute(){
		foreach (json_decode(file_get_contents('../src/Config/controllers.json'), true) as $uri => $value) {
			if (@$uri == $this->uri) {
				return new Route(self::CONTROLLER_NAMESPACE."\\".$value["path"]."\\".$value["controller"], "ActionMain");
			}
				//return "Controllers\\404";

		}

		if(self::CONTROLLER_NAMESPACE."\\404\\404"){
			self::CONTROLLER_NAMESPACE."\\404\\404";
		}
		return false;
	}
}

