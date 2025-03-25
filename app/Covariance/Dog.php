<?php

namespace App\Covariance;

use App\Contrvariance\Food;

class Dog extends Animal
{
    public function speak()
    {
        echo $this->name . " лает";
    }

    public function eat(Food $food)
    {
        echo $this->name . " ест " . get_class($food);
    }
}