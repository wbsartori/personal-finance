<?php

namespace App\Services\InstallmentPayment\Impl;

use App\Models\Output;
use App\Services\InstallmentPayment\InstallmentPaymentServiceInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\InstallmentPayment as InstallmentPaymentModel;
use Illuminate\Support\Carbon;

class InstallmentPaymentService implements InstallmentPaymentServiceInterface
{
    public function generate(array $payment, Model $model): void
    {
        $valueOfinstallment = $payment['installment_payment'] / $payment['installment'];
        for ($i = 1; $i <= $payment['installment']; $i++) {
            InstallmentPaymentModel::create([
                'output_id' => $model->id,
                'description' => $payment['description'] ?? $model->description,
                'value_of_installment' => $valueOfinstallment,
                'installment_number' => $i,
                'payment_value' => $valueOfinstallment,
                'payment_date' => $this->nextMonth($model, $i),
                'status' => strtolower('open'),
            ]);
            Output::create([
                'description' => $model->description,
                'type' => $model->type,
                'value' => $valueOfinstallment,
                'output_date' => $this->nextMonth($model, $i),
                'people_id' => $model->people_id,
            ]);
        }
    }

    public function generateNewOutput(array $payment, Model $model): void
    {
        // TODO: Implement generateNewOutput() method.
    }

    private function nextMonth(Model $paymentDate, int $addMonth)
    {
        if($addMonth === 1) {
            return $paymentDate->output_date;
        }
        $paymentDate = Carbon::parse($paymentDate->output_date);
        $nextMonthPaymentDate = $paymentDate->copy()->addMonthsNoOverflow($addMonth -1)->day($paymentDate->day);
        if ($nextMonthPaymentDate->day !== $paymentDate->day) {
            $nextMonthPaymentDate->endOfMonth();
        }
        return $nextMonthPaymentDate;
    }
}
