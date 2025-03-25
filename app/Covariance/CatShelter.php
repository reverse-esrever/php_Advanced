<?php

namespace App\Covariance;

class CatShelter implements AnimalShelter
{
    public function adopt(string $name): Cat // Возвращаем тип Cat вместо типа Animal
    {
        return new Cat($name);
    }
}