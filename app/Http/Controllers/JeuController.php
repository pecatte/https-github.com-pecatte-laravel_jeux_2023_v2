<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Jeu;

class JeuController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/jeux/",
    *     summary="Liste des jeux",
    *      @OA\Response(
    *          response=200,
    *          description="Successful operation",
    *       ),
    *     )
    *
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function list()
    {
        $jeux = Jeu::get();
        return response()->json($jeux);
    }
    /**
     * @OA\Post(
     *      path="/api/jeux",
     *      summary="Ajout d'un jeu",
     *      @OA\RequestBody(
     *          required=true,
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="nom_jeu",
     *                  description="nom du jeu",
     *                  type="string",
     *                  example="Uno",
     *                  nullable="false"
     *              ),
     *              @OA\Property(
     *                  property="nb_joueurs",
     *                  description="nombre de joeurs",
     *                  type="integer",
     *                  example=4,
     *                  nullable="false",
     *              ),
     *              @OA\Property(
     *                  property="regles",
     *                  description="description des regles du jeu",
     *                  type="string",
     *                  example="avoir une seule carte",
     *                  nullable="true",
     *              ),
     *              @OA\Property(
     *                  property="materiel",
     *                  description="liste du matériel",
     *                  type="string",
     *                  example="les cartes",
     *                  nullable="true",
     *              ),
     *              @OA\Property(
     *                  property="temps_partie",
     *                  description="temps moyen d'une partie",
     *                  type="time",
     *                  example="20:00",
     *                  nullable="false",
     *              ),
     *              @OA\Property(
     *                  property="id_categorie",
     *                  description="la catégorie du jeu",
     *                  type="integer",
     *                  example=1,
     *                  nullable="false",
     *              ),
     *              @OA\Property(
     *                  property="logo_jeu",
     *                  description="image logo du jeu",
     *                  type="file",
     *                  nullable="true",
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     * )
     */

    public function add(Request $req) {
        $njeu = new Jeu();
        $njeu->nom_jeu = $req->nom_jeu;
        $njeu->nb_joueurs = $req->nb_joueurs;
        $njeu->temps_partie = $req->temps_partie;
        $njeu->regles = $req->regles;
        $njeu->materiel = $req->materiel;
        $njeu->id_categorie = $req->id_categorie;
        // - pour le upload de fichier, ils sont stockés dans un dossier temp
        // la méthode save permet de les déplacer dans le dossier choisi
        // qui se trouve dans Storage/App
        // Pour rendre ces fichiers accessibles, il faudrait qu'elles soient dans le dossier Public de l'application
        // donc il faut créer un "lien symbolique" entre le dossier Public
        // et Storage/Appp
        // php artisan storage:link
        // la liste des liens est définie dans Config/filesystem.php
        // la méthode asset permettra de construie l'url, pour l'affichage des images par exemple
        // asset('storage/file.txt');
        $extension = $req->photo->getClientOriginalExtension();
        $fichier = $njeu->nom_jeu .'.'.$extension;
        $path = $req->photo->storeAs('image',$fichier);
        $njeu->logo_jeu = $path;
    // $file = $req->file('photo');
        dump($path);

        $njeu->id_user = Auth::id();
return response()->json($jeux);
  //      $ok = $njeu->save();
  //  $mess = $ok ? "Jeu ajouté" : "Pb lors de l'ajout";
}
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}