@extends('layouts.app')

@section('content')
<style media="screen">
  .pagination {
    padding-left: 660px;
  }
</style>

<div class="card">
  <div class="card-body">
  <div class="row">
    <div class="col-sm-12 text-center">
      <h1>Liste des partenaires </h1>
    </div>
    <div class="col-sm-5 text-center">
      <h2>Recherche :</h2>
    </div>
  </div>
<form id="search" name="search" method="get">
  <meta name="csrf-token" content="{{ csrf_token() }}" id="csrf" name="csrf">
  <div class="form-group row text-center">
    <label for="inputId" class="col-sm-2 col-form-label">Id :</label>
    <div class="col-sm-4">
      <input type="number" class="form-control" id="inputId" placeholder="Id">
    </div>
  </div>
  <div class="form-group row text-center">
    <label for="inputNom" class="col-sm-2 col-form-label">Nom : </label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="inputNom" placeholder="Nom">
    </div>
  </div>
    <div class="form-group row text-center">
      <div class="col-sm-6">
        <button type="button" id="actif" name="actif" class="btn btn-primary">Activé</button>
        <button type="button" id="inactif" name="inactif" class="btn btn-secondary">Désactivé</button>
        <input type="hidden" class="form-control" id="inputBool" name="inputBool" >
      </div>
    </div>
  <div class="form-group row text-center">
    <div class="col-sm-4">
      <button type="button" class="btn btn-primary" id="searchBtn" name="searchBtn">Rechercher</button>
    </div>
  </div></div></div>
</form><br><br>

<div class="container"id="client" name="client">
    <div class="row">
    @foreach ($clients as $client)
        <div class="col-sm-6 text-center">
          <div class="thumbnail">
            <img src="{{ URL::to('/') }}/img/car.jpg" alt="" width="50%">
            <div class="caption">
              Id: {{ $client->client_id }}<br>
              Nom: {{ $client->client_name }}<br>
              Description : {{ $client->short_description }}<br>
              Site : {{ $client->url }}<br>
              @if ($client->active == 0)
                Etat : Actif
                <button type="submit" class="btn btn-secondary">Désactiver</button>
              @else
                Etat : Inactif
                <button type="submit" class="btn btn-primary">Activer</button>
              @endif
                <a href="/show_partenaire/{{$client->client_id}}"class="btn btn-info">Consulter</a><br><br>
            </div>
          </div>
        </div>

    @endforeach
  </div>
  {{ $clients->links() }}
  </div><br><br>



@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    $("#searchBtn").click(function(){
      var id = $("#inputId").val();
      var nom = $("#inputNom").val();
      var bool = $('#inputBool').val();
      if(id ===''  )
      {
        id = "nil";
      }
      if(nom==='' )
      {
        nom = "nil";
      }
      if(bool==='' )
      {
        bool = "nil";
      }

      $.ajax({
      method: "GET",
      url: "/partenaire/"+id+"/"+nom+"/"+bool+"/",
      success: function(data){
        $("#client").load("/partenaire/"+id+"/"+nom+"/"+bool+"/" + " #client");
      }

    });

    });
  });
</script>
@endsection
