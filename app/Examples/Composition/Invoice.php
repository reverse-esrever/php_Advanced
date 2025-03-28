<?php

namespace App\Examples\Composition;

class Invoice
{

    public function __construct(protected SaleTaxCalculator $saleTaxCalculator)
    {
     
    }

    public function create()
    {
        $items = [
            ['unitPrice' => 100, 'quantity' => 3],
            ['unitPrice' => 150, 'quantity' => 2],
            ['unitPrice' => 300, 'quantity' => 4],
        ];

        $lineItemsTotal = $this->calculateLineItems($items);

        $salesTax = $this->saleTaxCalculator->calculate($lineItemsTotal);

        $total = $lineItemsTotal + $salesTax;

        echo "Sub total: " . $lineItemsTotal . "</br>";
        echo "Salex tax: " . $salesTax . "</br>";
        echo "Sub total: " . $total . "</br>";
    }

    public function calculateLineItems(array $items)
    {
        return array_sum(
            array_map(
                fn($item) => $item['unitPrice'] * $item['quantity'],
                $items
            )
        );
    }
}
