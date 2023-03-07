@extends('index')
@section('section')
<form method="post" action="{{ route('update',['idjeu'=>$jeu->id_jeu]) }}" class="well">
   <fieldsetclass="form-group">
    <legend>Modification jeu</legend>
    <div class="form-group row">
      <label for="nom_jeu" class="col-sm-2 col-form-label col-form-label-sm">Nom du jeu</label>
      <div class="col-sm-10">
        <input  type="text" id="nom_jeu" class="form-control form-control-sm" name="nom_jeu" value="{{ $jeu->nom_jeu }}" required placeholder="Nom du jeu ?" />
      </div>
    </div>
    <div class="form-group row">
      <label for="photo" class="col-sm-2 col-form-label col-form-label-sm">Photo</label>
      <div class="col-sm-10">
        <input type="file" id="photo" class="form-control form-control-sm" name="photo" placeholder="Photo ?"/>
      </div>
    </div>
    <div class="form-group row">
      <label for="regles" class="col-sm-2 col-form-label col-form-label-sm">Règles</label>
      <div class="col-sm-10">
        <input type="text" id="regles" class="form-control form-control-sm" name="regles" value="{{ $jeu->regles }}" required placeholder="Règles ?"/>
      </div>
    </div>
    <div class="form-group row">
      <label for="materiel" class="col-sm-2 col-form-label col-form-label-sm">Matériel</label>
      <div class="col-sm-10">
        <input  type="text" id="materiel" class="form-control form-control-sm" name="materiel" value="{{ $jeu->materiel }}" required placeholder="Matériel ?"/>
      </div>
    </div>
    <div class="form-group row">
      <label for="temps_partie" class="col-sm-2 col-form-label col-form-label-sm">Temps d'une partie</label>
      <div class="col-sm-10">
        <input type="time" id="temps_partie" class="form-control form-control-sm" name="temps_partie" value="{{ $jeu->temps_partie->format('H:i') }}" required placeholder="Temps d'une partie hh:mm"/>
      </div>
    </div>
    <div class="form-group row">
      <label for="nb_joueurs" class="col-sm-2 col-form-label col-form-label-sm">Nb de joueurs</label>
      <div class="col-sm-10">
        <input type="number" min="0" id="nb_joueurs" class="form-control form-control-sm" name="nb_joueurs" value="{{ $jeu->nb_joueurs }}" required placeholder="Nb de joueurs ?"/>
      </div>
    </div>
    <div class="form-group row">
      <label for="id_categorie" class="col-sm-2 col-form-label col-form-label-sm">Catégorie</label>
      <div class="col-sm-10">
        <select id="id_categorie" class="form-control form-control-sm" name="id_categorie"/>
          @foreach ($categories as $cat)
            @if ($jeu->id_categorie == $cat->id_categorie )
            <option value="{{ $cat->id_categorie }}" selected="selected">{{$cat->nom_categorie}}</option>
            @else
            <option value="{{ $cat->id_categorie }}">{{$cat->nom_categorie}}</option>
            @endif
          @endforeach
        </select>
      </div>
    </div>
	  <input type="submit" class="btn btn-primary" name="valider_modif" value="valider"/>
   </fieldset>
    @csrf
   </form>
@stop