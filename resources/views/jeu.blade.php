@extends('index')
@section('section')
<h3>{{ $jeu->nom_jeu }}</h3>
<img src="{{ asset($jeu->logo_jeu) }}"/>
<h4>proposé par <a class="btn btn-outline" href="{{ route('mesjeux',$jeu->users->id ) }}" >{{ $jeu->users->name }}</a></h4>
@if (count($jeu->commenters) === 0)
  <h4> aucun commentaire </h4>
@else
  <table class="table table-striped">
    <tr><th>Commentaire</th><th>Note</th><th></th></tr>
  @foreach ($jeu->commenters as $com)
  <tr><td>{{$com->commentaire}}</td><td>{{$com->note}}</td>
  <td><a class="btn btn-outline" href="{{ route('mesjeux',$com->users->id) }}">{{$com->users->name}}</a></td>
  </tr>
  @endforeach
  </table>
@endif
  @auth
  @if ($possible==true && $jeu->id_user != Auth::id())
  <form method="post" action="{{ route('commenter',$jeu->id_jeu) }}" class="well">
   <fieldset class="form-group">
    <legend>Nouveau commentaire</legend>
    <div class="form-group row">
      <label for="commentaire" class="col-sm-2 col-form-label col-form-label-sm">Commentaire</label>
      <div class="col-sm-10">
        <input  type="text" id="commentaire" class="form-control form-control-sm" name="commentaire" placeholder="Nom du jeu ?" />
      </div>
    </div>
    <div class="form-group row">
      <label for="note" class="col-sm-2 col-form-label col-form-label-sm">Note</label>
      <div class="col-sm-10">
        <input type="number" max="5" min="1" id="note" class="form-control form-control-sm" name="note" required placeholder="Règles ?"/>
      </div>
    </div>
    <input type="submit" class="btn btn-primary" name="valider_comm" value="valider"/>
   </fieldset>
    @csrf
  </form>

  @endif
  @endauth 

@stop