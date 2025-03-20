<?php

namespace App\Services;

class GatewayPaymentService implements GatewayPaymentServiceInterface
{
    public function charge(array $customer,float $amount,float $tax){
        return mt_rand(0,1);
    }
}