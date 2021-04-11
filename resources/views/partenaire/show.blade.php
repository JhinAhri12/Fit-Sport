@extends('layouts.app')

@section('content')

&nbsp;&nbsp;<a href="/partenaire" class="btn btn-info"> Retour à la liste des partenaires</a><br><br>

<div class="card">
  <div class="card-body">
    <div class="row">
      @foreach ($clients as $client)
      <div class="col-sm-4 text-center">
        <img src="{{ $client->logo_url }}" alt="" width="50%">
      </div>
        <div class="col-sm-4 text-center">
          Id client : {{ $client->client_id }} <input type="text" id="Idclient" value="{{ $client->client_id }}" hidden> <br><br>
          Nom Client : {{ $client->client_name }}<br><br>
          Description : {{ $client->full_description }}<br><br>
        </div>
        <div class="col-sm-4 text-center">
          Site web : {{ $client->url }}<br><br>
          Dpo : {{ $client->dpo }}<br><br>
          Technique : {{ $client->technical_contact }}<br><br>
          Commercial : {{ $client->commercial_contact }}<br><br>
        </div>
      @endforeach
    </div>
  </div>
</div>
<br><br>

<div class="card">
  <div class="card-body">
    <div class="row">
      @foreach ($grants as $grant)
      <div class="col-sm-4 text-center">
        {{ $grant->branch_id }}<br><br>
        @foreach ($clients as $client)
          @if ($client->active == 0)
            Etat : Actif
            <input type="submit" id="toggleA{{ $client->client_id }}" name="toggleA" class="btn btn-secondary" value="Désactiver"><br>
          @else
            Etat : Inactif
            <input type="submit" id="toggleA{{ $client->client_id }}" name="toggleA" class="btn btn-primary" value="Activer"><br>
          @endif
        @endforeach
      </div>
        <div class="col-sm-4 text-center">

        </div>
        <div class="col-sm-4 text-center">
          <button id="show" class="btn btn-info">Afficher les permissions</button><br><br>
          <button class="btn btn-success">Ajouter</button>
        </div>
      @endforeach
    </div>
  </div>
</div>

<br><br>

<div id="Refresh">
<div class="card" id="Permissions">
  <div class="card-body">
    <div class="row">
      @foreach ($grants as $grant)
      <div class="col-sm-4 text-center">
        id client : {{ $grant->client_id }}
        install id : {{ $grant->install_id }}
        branch id : {{ $grant->branch_id }}<br><br>
        @if ($grant->active == 0)
          Etat : Actif
          <input type="submit" id="toggleB{{ $grant->branch_id }}" name="toggleB" class="btn btn-primary" value="Désactiver"><br>
        @else
          Etat : Inactif
          <input type="submit" id="toggleB{{ $grant->branch_id }}" name="toggleB" class="btn btn-primary" value="Activer"><br>
        @endif
      </div>
        <div class="col-sm-4 text-center">

        </div>
        <div class="col-sm-4 text-center">
          <button id="hide" class="btn btn-info">Cacher les permissions</button><br><br>
        </div>
      @endforeach
    </div>
  </div>
</div>

<br><br>

<div class="card" id="PermissionsChange">
  <div class="card-body">
    <div class="row">
      @foreach ($installs as $install)
      <div class="col-sm-6 text-center">
        @if ($install->members_read == 0)
          Etat : Actif
          <button type="submit" class="btn btn-secondary">Désactiver</button><br><br>
        @else
          Etat : Inactif
          <button type="submit" class="btn btn-primary">Activer</button><br><br>
        @endif
        @if ($install->members_write == 0)
          Etat : Actif
          <button type="submit" class="btn btn-secondary">Désactiver</button><br><br>
        @else
          Etat : Inactif
          <button type="submit" class="btn btn-primary">Activer</button><br><br>
        @endif
        @if ($install->members_add == 0)
          Etat : Actif
          <button type="submit" class="btn btn-secondary">Désactiver</button><br><br>
        @else
          Etat : Inactif
          <button type="submit" class="btn btn-primary">Activer</button><br><br>
        @endif
        @if ($install->members_product_add == 0)
          Etat : Actif
          <button type="submit" class="btn btn-secondary">Désactiver</button><br><br>
        @else
          Etat : Inactif
          <button type="submit" class="btn btn-primary">Activer</button><br><br>
        @endif
        @if ($install->members_payment_schedules_read == 0)
          Etat : Actif
          <button type="submit" class="btn btn-secondary">Désactiver</button><br><br>
        @else
          Etat : Inactif
          <button type="submit" class="btn btn-primary">Activer</button><br><br>
        @endif
      </div>
        <div class="col-sm-6 text-center">
          @if ($install->members_statistiques_read == 0)
            Etat : Actif
            <button type="submit" class="btn btn-secondary">Désactiver</button><br><br>
          @else
            Etat : Inactif
            <button type="submit" class="btn btn-primary">Activer</button><br><br>
          @endif
          @if ($install->members_subscription_read == 0)
            Etat : Actif
            <button type="submit" class="btn btn-secondary">Désactiver</button><br><br>
          @else
            Etat : Inactif
            <button type="submit" class="btn btn-primary">Activer</button><br><br>
          @endif
          @if ($install->members_payment_schedules_read == 0)
            Etat : Actif
            <button type="submit" class="btn btn-secondary">Désactiver</button><br><br>
          @else
            Etat : Inactif
            <button type="submit" class="btn btn-primary">Activer</button><br><br>
          @endif
          @if ($install->payment_schedules_write == 0)
            Etat : Actif
            <button type="submit" class="btn btn-secondary">Désactiver</button><br><br>
          @else
            Etat : Inactif
            <button type="submit" class="btn btn-primary">Activer</button><br><br>
          @endif
          @if ($install->payment_day_read == 0)
            Etat : Actif
            <button type="submit" class="btn btn-secondary">Désactiver</button><br><br>
          @else
            Etat : Inactif
            <button type="submit" class="btn btn-primary">Activer</button><br><br>
          @endif
        </div>
      @endforeach
    </div>
  </div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    $("#Permissions").hide();
    $("#PermissionsChange").hide();

    $("#hide").click(function(){
      $("#Permissions").hide();
      $("#PermissionsChange").hide();
    });

    $("#show").click(function(){
      $("#Permissions").show();
      $("#PermissionsChange").show();
    });

    $("input[name='toggleB']").click(function(){
      var stringB = $(this).attr('id');
      var selectorB = '#'+stringB
      var stringidB = stringB.split('toggleB');
      var idB = stringidB[1];
      var valueB = $(selectorB).val();
      var boolB = '';
      var id = Number($('#Idclient').val());

      if(valueB === 'Activer')
      {
        boolB = 0;
      }
      else
      {
        boolB = 1;
      }

      $.ajax({
      method: "GET",
      url: "/update_grant_bool",
      data: { id: idB, bool: boolB },
      success: function(data){
        location.reload();
      }
      });
    });

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
      }
      else
      {
        boolA = 1;
      }

      $.ajax({
      method: "GET",
      url: "/update_partenaire_bool",
      data: { id: idA, bool: boolA },
      success: function(data){
        location.reload();
      }
      });
    });

  });
</script>
@endsection
