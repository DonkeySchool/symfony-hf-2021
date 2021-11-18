<?php

namespace App\Payment;

interface PaymentMethodInterface
{
    public function getName(): string;
    
    public function pay(int $amount): string;
}