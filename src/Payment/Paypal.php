<?php

namespace App\Payment;

class Paypal implements PaymentMethodInterface
{
    public function getName(): string
    {
        return "paypal";
    }

    public function pay(int $amount): string
    {
        return sprintf("Pay %d with paypal", $amount);
    }
}