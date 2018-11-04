@extends('layouts.app')

@section('content')

<div class="jumbotron text-center">
        <div class="container">
          <h1 class="display-3">Welkom bij Project Pogo</h1>
          <div>
            <img src="/storage/site_images/pogo_home.jpg" width="75%">
          </div>
          <br>
          <p>Hier lees je alles over nieuwetjes, Raids, updates en je kan al je vrienden opzoeken voor Pokémon GO!</p>
          <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Registreer</a></p>
        </div>
</div>

<div class="jumbotron text-center">
  <h1>Zoek je vrienden en voeg ze toe!</h1>
  <div>
      <img src="/storage/site_images/pogo_friends.jpg" width="75%">
  </div>
  <br>
  <p><a class="btn btn-primary btn-lg" href="/profiles" role="button">Klik hier en zoek!</a></p>
</div>

@endsection