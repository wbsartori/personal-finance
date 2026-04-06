<?php

namespace Database\Seeders;

use App\Enums\BandeiraCartao;
use App\Models\FinCartao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinCartaoSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cartoes = [
            [
                'descricao' => 'Cartão de Crédito',
                'dia_vencimento' => '4',
                'bandeira' => BandeiraCartao::MASTERCARD->value,
                'user_id' => 1,
                'limite_uso' => 2500,
                'limite_real' => 5000
            ],
            [
                'descricao' => 'Cartão de Débito',
                'dia_vencimento' => '4',
                'bandeira' => BandeiraCartao::VISA->value,
                'user_id' => 1,
                'limite_uso' => 1000,
                'limite_real' => 2000
            ]
        ];

        foreach ($cartoes as $cartao) {
            FinCartao::create($cartao);
        }
    }
}
