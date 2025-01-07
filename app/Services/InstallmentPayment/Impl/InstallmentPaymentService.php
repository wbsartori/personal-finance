<?php

namespace App\Services\InstallmentPayment\Impl;

use App\Services\InstallmentPayment\InstallmentPaymentServiceInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\InstallmentPayment as InstallmentPaymentModel;

class InstallmentPaymentService implements InstallmentPaymentServiceInterface
{
    public function generate(array $payment, Model $model): void
    {
        $valueOfinstallment = $payment['installment_payment'] / $payment['installment'];
        for ($i = 1; $i <= $payment['installment']; $i++) {
            InstallmentPaymentModel::create([
                'output_id' => $model->id,
                'description' => $model->description,
                'value_of_installment' => $valueOfinstallment,
                'installment_number' => $i,
                'payment_value' => $valueOfinstallment,
                'status' => strtolower('open'),
            ]);
        }
    }
}
