<?php

namespace App\Console\Commands;

use App\Models\Entry;
use App\Models\Output;
use App\Models\People;
use App\Models\User;
use Illuminate\Console\Command;

class AssignOrphanDataToUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assign-orphan-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assigns orphan records in people and entries tables to a specified user.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->ask('Qual é o ID do usuário que deve se tornar o dono dos registros existentes?');

        if (!is_numeric($userId) || !$user = User::find($userId)) {
            $this->error("Nenhum usuário encontrado com o ID: {$userId}. Operação cancelada.");
            return 1;
        }

        $this->info("Usuário '{$user->name}' (ID: {$user->id}) selecionado.");

        if (!$this->confirm('Você confirma que deseja atribuir todos os registros sem dono a este usuário?', true)) {
            $this->info('Operação cancelada pelo usuário.');
            return 1;
        }

        $this->info('Atualizando tabela "people"...');
        $peopleCount = People::whereNull('user_id')->update(['user_id' => $userId]);
        $this->info("{$peopleCount} registros atualizados em 'people'.");

        $this->info('Atualizando tabela "entries"...');
        $entriesCount = Entry::whereNull('user_id')->update(['user_id' => $userId]);
        $this->info("{$entriesCount} registros atualizados em 'entries'.");

        $this->info('Atualizando tabela "outputs"...');
        $outputsCount = Output::whereNull('user_id')->update(['user_id' => $userId]);
        $this->info("{$outputsCount} registros atualizados em 'outputs'.");

        $this->info("\nOperação concluída com sucesso!");

        return 0;
    }
}
