<?php

namespace Mpwarfwk\Component;

Class Container{
	private $arguments;
	public function get($service){
		include DOCUMENT_ROOT.'/src/Config/Services.php';
		$arguments = array();
		if (!empty($config[$service])){
			if(!empty($config[$service]['arguments'])){
				echo 'aaaa';
					foreach ($config[$service]['arguments'] as $argument){
						$arguments[] = new $argument();
					}
			}
			$reflection = new \ReflectionClass($config[$service]['class']);
			return $reflection->newInstanceArgs($arguments);
		}
	
		throw new \InvalidArgumentException();
	}
	
	
}