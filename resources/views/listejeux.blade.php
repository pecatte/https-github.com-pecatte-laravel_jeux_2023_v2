@extends('index')
@section('section')
<h3>{{ $titre ?? "Liste des jeux" }}</h3>
@if (count($jeux) === 0)
  <h4> aucun jeu </h4>
@else
  <table class="table table-striped">
    <tr><th>Nom du jeu</th><th>Nb joueurs</th><th></th></tr>
  @foreach ($jeux as $jeu)
  <tr><td><a class="btn btn-outline" href="{{ route('unjeu',$jeu->id_jeu) }}">{{$jeu->nom_jeu}}</a></td><td>{{$jeu->nb_joueurs}}</td>
      <td>
      @auth
       @if ($jeu->id_user === Auth::user()->id )
        <a  class="btn btn-outline-success" href="{{ route('delete',['idjeu' => $jeu->id_jeu]) }}">Delete</button>
        <a  class="btn btn-outline-success" href="{{ route('updateform',['idjeu' => $jeu->id_jeu]) }}">Update</button>
       @endif
      @endauth 
      </td>
  </tr>
  @endforeach
  </table>
@endif
@stop