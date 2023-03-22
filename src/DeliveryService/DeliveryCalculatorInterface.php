<?php

namespace App\DeliveryService;

interface DeliveryCalculatorInterface
{
    public function calculate(string $fromAddress, string $toAddress, float $weight, string $companyName): array;
}