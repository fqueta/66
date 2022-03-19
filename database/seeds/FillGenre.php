<?php

use Illuminate\Database\Seeder;

class FillGenre extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert(['name' => 'Pregão', 'name' => 'Concorrência', 'name' => 'Tomada de preço']);
        DB::table('phases')->insert(['name' => 'Aberto', 'name' => 'Finalizado']);
    }
}
