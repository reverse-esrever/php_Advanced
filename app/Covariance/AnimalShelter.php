<?php

namespace App\Covariance;

interface AnimalShelter
{
    public function adopt(string $name): Animal;
}