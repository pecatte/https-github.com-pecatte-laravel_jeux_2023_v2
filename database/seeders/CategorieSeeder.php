<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        DB::table('categories')->insert([
        'id_categorie' => '1',
        'nom_categorie' => 'Cartes',
        ]);
        DB::table('categories')->insert([
        'id_categorie' => '2',
        'nom_categorie' => 'Plateaux',
        ]);
        DB::table('categories')->insert([
        'id_categorie' => '3',
        'nom_categorie' => 'Dés',
        ]);

    }
}