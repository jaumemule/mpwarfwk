<?php

namespace Mpwarfwk\Component\Routing;

use Mpwarfwk\Component\Request\Request; 
use Mpwarfwk\Component\Response\Response; 

class Validator{

	protected $uri;
	protected $controllerUri;
	const  	  CONTROLLER_NAMESPACE = 'Validator';

	public function __construct( $validator_block ){


 		$this->validator_block = $validator_block;
		
	}

	public function validateInput(){

	}
}

