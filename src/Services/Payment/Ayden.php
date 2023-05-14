<?php

namespace App\Services\Payment;

class Ayden implements PaymentService
{
    /**
     * Request successful.
     */
    const AUTHORISED = 1;

    /**
     * Request successful.
     */
    const REFUSED = 2;

    public function charge($token, $amount, $currency = 'EUR'): array
    {
        return [];
    }

    public function refund(int $amount, string $transactionId): array
    {
        return [];
    }

    public function getErrorDefinitions(int $code): array
    {
        $errorMessage = ['service-errors.adyen.' . $code];
        return $errorMessage ?? ['message' => 'Payment failed'];
    }
}