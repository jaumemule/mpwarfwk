<?php

namespace Mpwarfwk\Component;

class Parameters{

	private 	$request;

	public function __construct($parms){
        $this->request = $parms;

		foreach ($this->request as $key => $value) {
			foreach ($value as $key => $value) {
				$this->$key = $value;
			}
		}

		return $this;
	}
}

