<?php

namespace Mpwarfwk\Component\Request;
use \stdClass;

use Mpwarfwk\Component\Session\Session;

class Request{

	public 	$request;
	public 		$data;


	public function __construct(Session $session){
 	$this->session = $session;
		$this->parseRequestType(

			array(
				'_get' 		=> $_GET ,
				'_post' 	=> $_POST ,
				'_server' 	=> $_SERVER ,
				'_file' 	=> $_FILES ,
				'_cookie' 	=> $_COOKIE ,
				'_session' 	=> $session 
				)
			);

		$_GET = $_POST = $_COOKIE = $_SERVER = array();

	}

	private function parseRequestType($ARRAY){

		foreach ($ARRAY as $keyReq => $valueReq) {

			$this->$keyReq = new \stdClass();

			foreach ($valueReq as $key => $value) {

				if(!empty($value)){
					$this->$keyReq->$key = $value;

				}
			}
		}
	}

}

