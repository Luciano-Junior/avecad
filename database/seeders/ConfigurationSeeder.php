<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("configurations")->insert([
            ["key"=>"valor_mensalidade", "value"=> "50.00", "created_at"=>now()],
            ["key"=>"dia_vencimento_padrao", "value"=> "10", "created_at"=>now()],
            ["key"=>"categoria_mensalidade_id", "value"=> "1", "created_at"=>now()],
        ]);
    }
}
