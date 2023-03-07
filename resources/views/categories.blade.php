@extends('index')
@section('section')
<h3>{{ "Liste des catégories" }}</h3>
  <table class="table table-striped">
    <tr><th>Nom de la catégorie</th><th></th></tr>
  @foreach ($categories as $cat)
  <tr><td>{{$cat->nom_categorie}} ({{count($cat->jeux)}} jeux)</td>
      <td>
      @if (count($cat->jeux)!=0)
        <button class="btn btn-outline-success" disabled>Delete</button>
      @else
        <a  class="btn btn-outline-success" href="{{ route('categories',['idcat' => $cat->id_categorie]) }}">Delete</a>
      @endif
        <a  class="btn btn-outline-success" href="{{ route('categories',['idcat' => $cat->id_categorie]) }}">Update</a>
      </td>
  </tr>
  @endforeach
  </table>
  <form method="post" action="{{ route('categories') }}" class="well">
   <fieldset class="form-group">
    <legend>Nouvelle catégorie</legend>
    <div class="form-group row">
      <div class="col-sm-10">
        <input  type="text" id="categorie" class="form-control form-control-sm" name="nom_categorie" placeholder="Nom catégorie ?" />
      </div>
    </div>
    <input type="submit" class="btn btn-primary" name="valider_comm" value="valider"/>
   </fieldset>
    @csrf
  </form>
@stop