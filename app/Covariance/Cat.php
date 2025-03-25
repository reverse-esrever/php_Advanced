<?php

namespace App\Covariance;

class Cat extends Animal
{
    public function speak()
    {
        echo $this->name . " мяукает";
    }
}