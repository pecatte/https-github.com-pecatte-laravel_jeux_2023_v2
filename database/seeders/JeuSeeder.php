<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JeuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jeux')->delete();
        DB::table('jeux')->insert([
        'id_jeu' => '1',
        'nom_jeu' => 'Belote',
        'logo_jeu' => '',
        'nb_joueurs' => 4,
        'temps_partie' => '20:00',
        'regles' => 'faire plus de 81 points',
        'materiel'=>'Jeu de 32 cartes',
        'id_categorie' => 1,
        'id_user' => 1
        ]);
    }
}