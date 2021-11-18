<?php

namespace App\Payment;

class PaymentManager
{
    private array $methods = [];

    public function payWith(int $amount, string $method) : ?string
    {
        return $this->methods[$method]->pay($amount);
    }

    public function registerMethod(PaymentMethodInterface $method): void
    {
        $this->methods[$method->getName()] = $method;
    }
}