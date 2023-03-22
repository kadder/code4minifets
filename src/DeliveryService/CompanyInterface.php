<?php

namespace App\DeliveryService;

interface CompanyInterface
{
    public function calculate(string $fromAddress, string $toAddress, float $weight): array;
}