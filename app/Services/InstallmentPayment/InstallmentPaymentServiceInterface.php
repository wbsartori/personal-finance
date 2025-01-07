<?php

namespace App\Services\InstallmentPayment;

use Illuminate\Database\Eloquent\Model;

interface InstallmentPaymentServiceInterface
{
    public function generate(array $payment, Model $model): void;
    public function generateNewOutput(array $payment, Model $model): void;
}
