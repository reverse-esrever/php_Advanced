<?php

namespace App\Services;

class InvoiceService
{
    public function __construct(
        protected SaleTaxService $salesTaxService,
        protected GatewayPaymentService $gatewayPaymentService,
        protected EmailService $emailService,
    )
    {
        
    }
    public function process(array $customer, float $amount){
        // $tax = $this->salesTaxService->calculate($amount, $customer);

        // if(! $this->gatewayPaymentService->charge($customer, $amount, $tax)){
        //     return false;
        // }

        // $this->emailService->send($customer, 'receipt');

        echo "processed invoice!";

        return true;
    }
}

