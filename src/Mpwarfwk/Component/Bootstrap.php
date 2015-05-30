<?php

namespace Mpwarfwk\Component;

use Mpwarfwk\Component\Request\Request;
use Mpwarfwk\Component\Session\Session; 
use Mpwarfwk\Component\Session\Token; 
use Mpwarfwk\Component\Routing\Router; 
use Mpwarfwk\Component\Routing\Route; 

class Bootstrap{

	protected $env;
	protected $debug;

	public function __construct($env = 'prod', $debug = false){
		$this->env 		= $env;
		$this->debug 	= $debug;
	}

	public function execute(Request $Request){

		$token 				= new Token($Request);
		$token 				= $token->validate();

		if($token == true){

			$Router 			= new Router($Request);
			$ControllerUri 		= $Router->getRoute($Request);

			$response = $this->executeController($ControllerUri, $Request);

	        return $response;
			
		}else{
			die();
		}

	}

	public function executeController(Route $route, Request $Request){

        $controller_class = $route->getRouteClass();

        return call_user_func_array(
            array(
                new $controller_class($Request),
                $route->getRouteAction()
            ),
            array($Request)
        );
    
	}
}

