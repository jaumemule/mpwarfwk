<?php

namespace Mpwarfwk\Component\Request;
use \stdClass;

use Mpwarfwk\Component\Session\Session;

class Request{

	public 	$request;
	public 		$data;


	public function __construct(Session $session){
 	$this->session = $session;


	if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
	    parse_str(file_get_contents("php://input"), $_PUT);

	    foreach ($_PUT as $key => $value)
	    {
	        unset($_PUT[$key]);

	        $_PUT[str_replace('amp;', '', $key)] = $value;
	    }

	    $_REQUEST = array_merge($_REQUEST, $_PUT);
	}
	if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
	    parse_str(file_get_contents("php://input"), $_DELETE);

	    foreach ($_DELETE as $key => $value)
	    {
	        unset($_DELETE[$key]);

	        $_DELETE[str_replace('amp;', '', $key)] = $value;
	    }

	    $_REQUEST = array_merge($_REQUEST, $_DELETE);
	}
 	$delete = [];
 	if(@$_DELETE){
 		$delete = $_DELETE;
 	}

 	$put = [];
 	if(@$_PUT){
 		$put = $_PUT;
 	}

		$this->parseRequestType(

			array(
				'_get' 		=> $_GET ,
				'_post' 	=> $_POST ,
				'_put' 		=> $put ,
				'_delete' 	=> $delete ,
				'_server' 	=> $_SERVER ,
				'_file' 	=> $_FILES ,
				'_cookie' 	=> $_COOKIE ,
				'_session' 	=> $session 
				)
			);

		$_GET = $_POST = $_COOKIE = $_SERVER = array();

	}

	private function parseRequestType($ARRAY)
	{

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

