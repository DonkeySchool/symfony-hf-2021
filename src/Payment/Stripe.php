<?php

namespace App\Payment;

class Stripe implements PaymentMethodInterface
{
    public function getName(): string
    {
        return "stripe";
    }
    
    public function pay(int $amount): string
    {
        return sprintf("Pay %d with stripe", $amount);
    }
}