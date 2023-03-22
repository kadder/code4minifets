<?php

namespace App\DeliveryService;

class DeliveryCalculator implements DeliveryCalculatorInterface
{
    public function calculate(string $fromAddress, string $toAddress, float $weight, string $companyName): array
    {
        return $this->getCompany($companyName)->calculate($fromAddress, $toAddress, $weight);
    }

    public function getCompany(string $companyName): CompanyInterface
    {
        // @todo заменить на фабрику или стратегию
        $companies = [
            'fast' => new FastCompany(),
            'slow' => new SlowCompany()
        ];

        return $companies[$companyName];
    }
}