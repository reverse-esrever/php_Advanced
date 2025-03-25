<?php

namespace App\Covariance;

use App\Contrvariance\AnimalFood;

abstract class Animal
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function speak();

    public function eat(AnimalFood $food)
    {
        echo $this->name . " ест " . get_class($food);
    }
}