<?php

namespace App\Examples\Attributes;

class Config
{
    protected array $props = [];

    #[SetUp]
    public function setProps($data){
        $this->props[] = $data;
    }
    #[SetUp]
    public function build(){
        var_dump($this);
        return $this;
    }
}