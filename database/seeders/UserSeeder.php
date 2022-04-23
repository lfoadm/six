<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_usuarios')->insert([
            'usuario' => 'lfoadm@icloud.com',
            'ativo' => true,
            'nome' => 'Leandro Oliveira',
            'nick' => 'leandrinhoo20',
            'senha' => Hash::make('password'),
            'funcao' => 'SuperAdmin',
            'celular' => '(34) 99974-9344',
            'email' => 'lfoadm@icloud.com',
            'foto' => false,
            'permissao001' => true,
            'permissao002' => true,
            'permissao003' => true,
            'permissao004' => true,
            'permissao005' => true,
        ]);

        DB::table('t_usuarios')->insert([
            'usuario' => 'carol@icloud.com',
            'ativo' => true,
            'nome' => 'Carol Mendonça',
            'nick' => 'Carolzinha',
            'senha' => Hash::make('password'),
            'funcao' => 'Secretaria',
            'celular' => '(34) 99992-4794',
            'email' => 'carol@icloud.com',
            'foto' => false,
            'permissao001' => false,
            'permissao002' => false,
            'permissao003' => false,
            'permissao004' => false,
            'permissao005' => false,
        ]);
    }
}
