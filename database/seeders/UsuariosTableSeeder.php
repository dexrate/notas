<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criando varios usuarios
        DB::table('usuarios')->insert([
            [
                'usuario' => 'user1@eicos.com.br',
                'senha' => bcrypt('1234678'),
                'created_at' => now(),
            ],
            [
                'usuario' => 'user2@eicos.com.br',
                'senha' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'usuario' => 'user3@eicos.com.br',
                'senha' => bcrypt('123456789'),
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
            ]
        ]);
    }
}
