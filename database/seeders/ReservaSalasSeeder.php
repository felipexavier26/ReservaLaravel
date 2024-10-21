<?php

namespace Database\Seeders;

use App\Models\ReservaSala;
use Illuminate\Database\Seeder;

class ReservaSalasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!ReservaSala::where('nome_sala', 'sala2')->first()) {
            ReservaSala::create([
                'nome_sala' => 'sala2',
                'dt_hr_inicio' => now(),
                'dt_hr_termino' => now()->addHours(2),
                'nome_responsavel' => 'João Silva',
            ]);
        }
    }
}
