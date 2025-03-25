<?php

namespace App\Covariance;

class DogShelter implements AnimalShelter
{
    public function adopt(string $name): Dog // Возвращаем тип Dog вместо типа Animal
    {
        return new Dog($name);
    }
}