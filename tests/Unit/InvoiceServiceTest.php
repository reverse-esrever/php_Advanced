<?php

namespace Tests\Unit;

use App\Services\EmailService;
use App\Services\GatewayPaymentService;
use App\Services\InvoiceService;
use App\Services\SaleTaxService;
use PHPUnit\Framework\TestCase;

class InvoiceServiceTest extends TestCase
{
    public function testItProcess(){
        $salesTaxService = $this->createMock(SaleTaxService::class);
        $gatewayPaymentService = $this->createMock(GatewayPaymentService::class);
        $emailService = $this->createMock(EmailService::class);

        $invoiceService = new InvoiceService($salesTaxService, $gatewayPaymentService, 
        $emailService);

        $gatewayPaymentService->method('charge')->willReturn(true);

        $customer = ['name' => 'John'];

        $result = $invoiceService->process($customer, 125);

        $this->assertTrue($result);
    }

    public function testItSendsReceiptWhenInvoiceIsProcessed(){
        $salesTaxService = $this->createMock(SaleTaxService::class);
        $gatewayPaymentService = $this->createMock(GatewayPaymentService::class);
        $emailService = $this->createMock(EmailService::class);

        $gatewayPaymentService->method('charge')->willReturn(true);
        $customer = ['name' => 'Joh'];

        $emailService->expects($this->once())
        ->method('send')
        ->with($customer, 'receipt');

        $invoiceService = new InvoiceService($salesTaxService, $gatewayPaymentService, 
        $emailService);



        $result = $invoiceService->process($customer, 125);

        $this->assertTrue($result);
    }
}