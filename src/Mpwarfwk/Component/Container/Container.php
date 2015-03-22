<?php

namespace Mpwarfwk\Component\Container;

class Container{

    private $arguments;

    public function __construct() {

        $this->arguments = array();
    }

    public function get($service){

        foreach (json_decode(file_get_contents('../src/Config/services.json'), true) as $serviceList => $value) {
            if (@$serviceList == $service) {
                    
                foreach ($value["arguments"] as $arg) {

                    $this->arguments[] = new $arg();

                }
                   
                $reflection   =   new \ReflectionClass( $value["class"] );
                return $reflection->newInstanceArgs( $this->arguments );

            }
        }

    }
}