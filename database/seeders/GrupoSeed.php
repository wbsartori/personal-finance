<?php

namespace Database\Seeders;

use App\Models\FinGrupo;
use App\Models\FinSubGrupo;use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrupoSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grupos = [
            [
                'descricao' => 'Moradia',
                'subgrupos' => [
                    'Aluguel',
                    'Financiamento de imóvel',
                    'Condomínio',
                    'Manutenção da casa',
                ],
            ],
            [
                'descricao' => 'Alimentação',
                'subgrupos' => [
                    'Supermercado',
                    'Padaria',
                    'Açougue',
                    'Feira',
                ],
            ],
            [
                'descricao' => 'Restaurantes e Delivery',
                'subgrupos' => [
                    'Restaurante',
                    'Delivery',
                    'Lanches',
                ],
            ],
            [
                'descricao' => 'Transporte',
                'subgrupos' => [
                    'Combustível',
                    'Uber',
                    'Taxi',
                    'Transporte público',
                    'Manutenção do carro',
                ],
            ],
            [
                'descricao' => 'Saúde',
                'subgrupos' => [
                    'Plano de saúde',
                    'Farmácia',
                    'Consultas médicas',
                    'Exames',
                ],
            ],
            [
                'descricao' => 'Educação',
                'subgrupos' => [
                    'Cursos',
                    'Faculdade',
                    'Livros',
                    'Treidescricaontos',
                ],
            ],
            [
                'descricao' => 'Lazer e Entretenimento',
                'subgrupos' => [
                    'Cinema',
                    'Streaming',
                    'Viagens',
                    'Eventos',
                ],
            ],
            [
                'descricao' => 'Contas e Serviços',
                'subgrupos' => [
                    'Energia elétrica',
                    'Água',
                    'Internet',
                    'Celular',
                ],
            ],
            [
                'descricao' => 'Compras Pessoais',
                'subgrupos' => [
                    'Roupas',
                    'Calçados',
                    'Acessórios',
                    'Eletrônicos',
                ],
            ],
            [
                'descricao' => 'Investimentos',
                'subgrupos' => [
                    'Poupança',
                    'Ações',
                    'Fundos',
                    'Reserva de emergência',
                ],
            ],
        ];

        foreach ($grupos as $grupo) {
            $novoGrupo = FinGrupo::create(['descricao' => $grupo['descricao']]);

            foreach ($grupo['subgrupos'] as $subgrupo) {
                FinSubGrupo::create(['descricao' => $subgrupo, 'fin_grupos_id' => $novoGrupo->id]);
            }
        }
    }
}
