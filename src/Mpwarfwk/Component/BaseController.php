<?php

namespace Mpwarfwk\Component;
use Mpwarfwk\Component\Request;

abstract class BaseController{

	protected $_req;

	public function __construct(){
		$this->_req = new Request;
	}
}

