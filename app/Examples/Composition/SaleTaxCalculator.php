<?php

namespace App\Examples\Composition;

class SaleTaxCalculator
{
    public function calculate(int|string $total){
        return round($total * 7/100, 2);
    }
}