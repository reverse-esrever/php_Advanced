<?php

namespace App\Services;

class SaleTaxService
{
    public function calculate(float $amount,array $customer) : float{
        // sleep(1);

        return 0.65;
    }
}