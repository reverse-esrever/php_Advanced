<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\App;
use App\Container;
use App\Services\EmailService;
use App\Services\GatewayPaymentService;
use App\Services\InvoiceService;
use App\Services\SaleTaxService;
use App\View;

class HomeController
{
    public function __construct(private InvoiceService $invoiceService)
    {
        
    }

    public function index()
    {

        $this->invoiceService->process([], 25);
    }
}
