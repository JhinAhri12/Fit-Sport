@extends('layouts.app')

@section('content')

<!-- Zone recherche -->
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
    <label for="inputNom" class="col-sm-2 col-form-label">Statut : </label>
      <div class="col-sm-2">
        <button type="button" id="actif" name="actif" class="btn btn-primary">Activé</button>
        <button type="button" id="inactif" name="inactif" class="btn btn-secondary">Désactivé</button>
        <input type="hidden" class="form-control" id="inputBool" name="inputBool" value="">
      </div>
    </div>
  <div class="form-group row text-center">
    <div class="col-sm-6">
      <!-- Bouton recherche && annuler la recherche -->
      <button type="button" class="btn btn-success" id="searchBtn" name="searchBtn"><span class="fas fa-search"></span> Rechercher</button>&nbsp;&nbsp;<a style="color:white;" href="/partenaire" class="btn btn-warning"><span class="fas fa-ban"></span> Annuler la recherche</a>
    </div>
  </div></form></div></div>
<br><br>

<!-- Zone d'affichage pour UN client -->
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
              Site web : <a href="{{ $client->url }}">{{ $client->url }}</a><br>
              <!-- Toggle pour activer ou désactiver -->
              @if ($client->active == 0)
                <input style="margin-bottom:5px;" type="submit" id="toggleA{{ $client->client_id }}" name="toggleA" class="btn btn-secondary" value="Désactiver"><br>
              @else
                <input style="margin-bottom:5px;" type="submit" id="toggleA{{ $client->client_id }}" name="toggleA" class="btn btn-primary" value="Activer"><br>
              @endif
                <a href="/show_partenaire?id={{$client->client_id}}"class="btn btn-info"><span class="fas fa-search"></span> Consulter</a><br><br>
            </div>
          </div>
        </div>
    @endforeach
    <div class="col-sm-12 text-center">
      <!-- Pagination -->
      <center>{{ $clients->links() }}</center>
    </div>
  </div>

</div><br><br>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function(){

    // si on appuie sur un bouton état on change active
    $("input[name='toggleA']").click(function(){
        var stringA = $(this).attr('id');
        var selectorA = '#'+stringA
        var stringidA = stringA.split('toggleA');
        var idA = stringidA[1];
        var valueA = $(selectorA).val();
        var boolA = '';

        if(valueA === 'Activer')
        {
          boolA = 0;
          var c = confirm("Êtes vous certain de désactiver ce client et tout ses clubs ?");
        }
        else
        {
          boolA = 1;
          var c = confirm("Êtes vous certain d'activer ce client et tout ses clubs ?");
        }

        if(c === true)
        {
          $.ajax({
          method: "GET",
          url: "/update_partenaire_bool",
          data: { id: idA, bool: boolA },
          success: function(data){
            location.reload();
          }
        });
      }
    });

// on met en valeur si un bouton est appuyé pour la recherche et on met en blanc l'autre
    $("#actif").click(function(){
      var selected = $(this).attr("class");
      $(this).removeClass(selected);
      $(this).addClass('btn btn-primary');
      var classI = $('#inactif').attr("class");
      $('#inactif').removeClass(classI);
      $('#inactif').addClass('btn btn-light');
      $('#inputBool').val('');
      $('#inputBool').val(0);
    });

// on met en valeur si un bouton est appuyé pour la recherche et on met en blanc l'autre
    $("#inactif").click(function(){
      var selected = $(this).attr("class");
      $(this).removeClass(selected);
      $(this).addClass('btn btn-primary');
      var classA = $('#actif').attr("class");
      $('#actif').removeClass(classA);
      $('#actif').addClass('btn btn-light');
      $('#inputBool').val('');
      $('#inputBool').val(1);
    });

// Si on appuie sur le bouton de recherche on lance une requete et on ouvre le résulat dans la même fenêtre
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
        window.open("/partenaire/"+id+"/"+nom+"/"+bool+"/", '_parent');
      }

    });
  });
});
</script>
@endsection
