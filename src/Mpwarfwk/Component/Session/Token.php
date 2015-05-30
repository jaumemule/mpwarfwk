<?php

namespace Mpwarfwk\Component\Session;

use Mpwarfwk\Component\Request\Request; 
use Mpwarfwk\Component\Utils\CharGenerator; 

class Token{

	private $request;

	public function __construct(Request $request)
	{
		
		$this->request = $request;

	}

	public function validate()
	{

		if(@$this->request->_post->_token){
			return $this->checkToken($this->request->_post->_token);
		}

		if(@$this->request->_put->_token){
			return $this->checkToken($this->request->_put->_token);
		}

		if(@$this->request->_delete->_token){
			return $this->checkToken($this->request->_delete->_token);
		}

		if(@$this->request->_get->_token){
			return $this->checkToken($this->request->_get->_token);
		}

		return $this->generateToken();

	}

	private function checkToken( $token )
	{

		if($this->request->session->getValue("_token") == $token){
			return true;
		}

		return false;

	}

	private function generateToken()
	{
		$CharGenerator 	= new CharGenerator();

		$this->request->session->setValue("_token", $CharGenerator->createString( ));
		return true;

	}

}

