<?php

namespace Mpwarfwk\Component\Routing;

use Mpwarfwk\Component\Request\Request; 

class Router{

	protected $uri;
	protected $controllerUri;
	const  	  CONTROLLER_NAMESPACE = 'Controllers';

	public function __construct(Request $request){


		$specialChar = explode("/?", $request->_server->REQUEST_URI);
		$this->uri = trim($specialChar[0], "/");
		
	}

	public function getRoute(){
		foreach (json_decode(file_get_contents('../src/Config/controllers.json'), true) as $uri => $value) {
			if (@$uri == $this->uri) {
				return new Route(self::CONTROLLER_NAMESPACE."\\".$value["path"]."\\".$value["controller"], "ActionMain");
			}
		}

		 throw new \Exception(' ERROR 404 . PATH NOT FOUND ');
	}
}
