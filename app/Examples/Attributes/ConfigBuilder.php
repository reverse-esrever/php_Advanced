<?php

namespace App\Examples\Attributes;

use ReflectionClass;
use ReflectionObject;

class ConfigBuilder
{
    public function execute(Config $config){
        $reflection = new ReflectionObject($config);
        $methods = $reflection->getMethods();
        foreach ($methods as $method) {
            $attributes = $method->getAttributes(SetUp::class);
            if(count($attributes) > 0){
                $name = $method->getName();
                $config->$name([1,2,3]);
            }
        }
    }
}