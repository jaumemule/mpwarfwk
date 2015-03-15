<?php

namespace Mpwarfwk\Component;

class Request{

	public 		$request;
	private 	$data;

	public function __construct(){

		$this->request = array(
			'GET' 		=> $_GET ,
			'POST' 		=> $_POST ,
			'SERVER' 	=> $_SERVER ,
			'FILES' 	=> $_FILES ,
			);

		$this->parseRequestType();
		$this->method 		= $_SERVER['REQUEST_METHOD'];
		$this->request_uri  = $_SERVER['REQUEST_URI'];

		if(!@$_SERVER){
			$this->fetchServer();
		}

		if(@$_COOKIES){
			$this->fetchCookies();
		}
	}

	private function parseRequestType(){

		foreach ($this->request as $key => $value) {
			foreach ($value as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	private function fetchServer(){

		foreach ($_SERVER as $key => $value) {
			$this->server->$key = $value;
		}
		
	}

	private function fetchCookies(){

		foreach ($_COOKIES as $key => $value) {
			$this->cookie->$key = $value;
		}
	}

	public function getRequested(){
		return $this;
	}
}

