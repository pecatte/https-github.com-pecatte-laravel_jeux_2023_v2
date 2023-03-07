<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\JeuController;

use App\Models\Jeu;
use App\Models\Categorie;
use App\Models\Commenter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('index');
});
// ----> accueil
Route::get('accueil', function () {
    return view('index');
})->name('accueil');

// ----> liste des jeux
Route::get('liste', function () {
    $jeux = DB::select('select * from jeuxjeux');
    // $jeux =  Livre::get();

    return view('listejeux',['jeux'=>$jeux]);

})->name('liste');

// ----> liste des jeux d'un user (connecté ou pas)
Route::get('mesjeux/{id_user?}', function ($id_user=0) {
    if ($id_user!=0)
        $jeux =  Jeu::where("id_user",$id_user)->get();
    else 
        $jeux =  Jeu::where("id_user",Auth::id())->get();

    return view('listejeux',['titre'=>'Liste de mes jeux','jeux'=>$jeux]);
})->name('mesjeux');

// ----> ajout d'un jeu : formulaire
Route::get('ajouter', function () {
    $categories = Categorie::get();
    return view('ajoutjeu',['categories'=>$categories]);
})->name('ajouter');

// ----> ajout d'un jeu : save dans la BD
Route::post('ajout', function (Request $req) {
    $njeu = new Jeu();
    $njeu->nom_jeu = $req->input("nom_jeu");
    $njeu->nb_joueurs = $req->nb_joueurs;
    $njeu->temps_partie = $req->temps_partie;
    $njeu->regles = $req->regles;
    $njeu->materiel = $req->materiel;
    $njeu->id_user = Auth::id();
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
    $ok = $njeu->save();
    $mess = $ok ? "Jeu ajouté" : "Pb lors de l'ajout";
    // return view('index',['message'=>$message]);
    return redirect()->route('mesjeux')->with('success', $mess);
})->name('ajout');;

// ----> suppresion d'un jeu

Route::get('delete/{idjeu}', function ($idjeu) {
    $jeu = Jeu::find($idjeu);
    $ok = $jeu->delete();
    $mess = $ok ? "Jeu supprimé" : "Pb lors de la suppression";
    // return view('index',['message'=>$message]);
    return redirect()->route('mesjeux')->with('success', $mess);
})->name('delete');

// ----> modification d'un jeu : affichage d'un form
Route::get('updateform/{idjeu}', function ($idjeu) {
    $jeu = Jeu::find($idjeu);
    $categories = Categorie::get();
    //var_dump($jeu);
    return view('modifijeu',['jeu'=>$jeu,'categories'=>$categories]);
})->name('updateform');

Route::post('update/{idjeu}', function (Request $req,$idjeu) {
    $jeu = Jeu::find($idjeu);
    var_dump($jeu);
    $jeu->nom_jeu = $req->nom_jeu;
    $jeu->nb_joueurs = $req->nb_joueurs;
    $jeu->temps_partie = $req->temps_partie;
    $jeu->regles = $req->regles;
    $jeu->materiel = $req->materiel;
    $jeu->id_user = Auth::id();
    $jeu->id_categorie = $req->id_categorie;

if ($req->hasFile('photo')) {
    //$path = $req->photo->store('image');
    //$jeu->logo_jeu = $path;
    $extension = $req->photo->getClientOriginalExtension();
    $fichier = $njeu->nom_jeu .'.'.$extension;
    $path = $req->photo->storeAs('image',$fichier);
    $njeu->logo_jeu = $path;
}
    $ok = $jeu->save();
    $mess = $ok ? "Jeu modifié" : "Pb lors de la modification";
    return redirect()->route('mesjeux')->with('success', $mess);
})->name('update');

// ----  un jeu depuis son id
Route::get('unjeu/{idjeu}', function ($idjeu) {
    $jeu = Jeu::find($idjeu);//->commenters()->get();
    //dump($jeu);
    // le user connecté a déjà commenté ?
    $possible = true;
    if (Auth::check()) {
       foreach($jeu->commenters as $com) {
           //dump($com->id_user);
           if ($com->id_user == Auth::id()) $possible = false;
        }
    }
    //dump($possible);
    return view('jeu',['jeu'=>$jeu, "possible"=>$possible]);
})->name('unjeu');

// - recherche
Route::get('recherche', function (Request $req) {
    $jeux = Jeu::where("nom_jeu","like","%".$req->search."%")->get();
    return view('listejeux',['titre'=>'Résultat de la recherche','jeux'=>$jeux]);
})->name('recherche');

// -- commentaires
// ----> ajout d'un commentaire : save dans la BD
Route::post('commenter/{idjeu}', function (Request $req, $idjeu) {
    $ncomm = new Commenter();
    $ncomm->commentaire = $req->commentaire;
    $ncomm->note = $req->note;
    $ncomm->id_user = Auth::id();
    $ncomm->id_jeu = $idjeu;
    var_dump($ncomm);
    $ok = $ncomm->save();
    $mess = $ok ? "Jeu ajouté" : "Pb lors de l'ajout";
    // return view('index',['message'=>$message]);
    return redirect()->route('unjeu',$idjeu)->with('success', $mess);
})->name('commenter');;

// -- admins de l'appli
// -- gestion des catégories
Route::get('categories', function (Request $req) {
    $categories = Categorie::get();
    return view('categories',['categories'=>$categories]);
})->name('categories');
Route::post('categories', function (Request $req) {
    $categorie = new categorie();
    $categorie->nom_categorie =  $req->nom_categorie;
    $ok = $categorie->save();
    $mess = $ok ? "Categorie ajoutée" : "Pb lors de l'ajout";
    return redirect()->route('categories')->with('success', $mess);

    return view('categories',['categories'=>$categories]);
})->name('categories');
// -- gestion des commentaires
Route::get('commentaires', function (Request $req) {
    return view('index');
})->name('commentaires');

// --- routes authentification

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');