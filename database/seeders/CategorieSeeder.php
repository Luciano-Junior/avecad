<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("categories")->insert([
            ["name"=>"Mensalidade", "description"=> "Mensalidade dos Associados"],
            ["name"=>"Aluguel", "description"=> "Despesas com aluguel"],
            ["name"=>"Despesa Fixa", "description"=> "Despesas fixas"],
            ["name"=>"Materiais", "description"=> "Materiais como Uniformes e Materiais Esportivos"],
            ["name"=>"Doações e Patrocínios", "description"=> "Doações e Patrocínios"],
            ["name"=>"Alimentação", "description"=> "Despesas com Alimentação"],
        ]);
    }
}
