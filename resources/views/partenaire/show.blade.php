@extends('layouts.app')

@section('content')

<div class="refreshUpdate">
&nbsp;&nbsp;<a href="/partenaire" class="btn btn-info"><span class="fas fa-arrow-circle-left"></span> Retour à la liste des partenaires</a><br><br>


<div id="modalAdd" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajouter un club</h5>
      </div>
      <div class="modal-body">
        <form id="formCreate" action="/create_structure" method="post">
          @csrf
          <div class="row">
            <div class="col-sm-12">
              <label class="form-label" for="nom_club">Nom du club</label>
              <input class="form-control" type="text" name="nom_club" value="" ><br>
            </div>
            <div class="col-sm-12">
              <h3> Permissions : </h3>
            </div>
            <div class="col-sm-6">
              <textarea name="perms" rows="8" cols="80">
              {"members_read":0,"members_write":0,"members_add":0,"members_product_add":0,"members_payment_schedules_read":0,"members_statistiques_read":0,"members_subscription_read":0,"payment_schedules_read":0,"payment_schedules_write":0,"payment_day_read":0}
              </textarea>
            </div>
          </div>
          <input type="text" name="client_id" value="">
        </form>
      </div>
      <div class="modal-footer">
        <button id="create" type="button"  class="btn btn-success">Valider</button>
        <button id="cancel" type="button"  class="btn btn-danger" data-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>

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
    <div class="row">
    <div class="col-sm-6 text-center">
      <a style="margin-bottom: :30px" href="/viewEmail?nom={{ $client->client_name }}"  class="btn btn-danger"><span class="fas fa-envelope"></span> Consulter l'Email</a>
    </div>
    <div class="col-sm-6 text-center">
      <button style="margin-bottom:30px" id="add" class="btn btn-success"><span class="fas fa-plus-circle"></span> Ouvrir l'accès à un club</button>
    </div>
      <div class="col-sm-12 text-center">
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
    </div>
  </div>
</div>

<br><br>


@foreach ($grants as $grant)
<div class="card" id="PermissionsChange">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-6 text-center">
        id client : {{ $grant->client_id }}
        install id : {{ $grant->install_id }}
        branch id : {{ $grant->branch_id }}<br><br>
        <input type="text" id="Idbranch" value="{{ $grant->branch_id }}" hidden>
        @if ($grant->active == 0)
          Etat : Actif
          <input type="submit" id="toggleB{{ $grant->branch_id }}" name="toggleB" class="btn btn-primary" value="Désactiver"><br>
        @else
          Etat : Inactif
          <input type="submit" id="toggleB{{ $grant->branch_id }}" name="toggleB" class="btn btn-primary" value="Activer"><br>
        @endif
      </div>
      <div class="col-sm-6 text-center">
        <button id="update{{$grant->install_id}}" name="updatePerm" type="button" class="btn btn-info" name="button"><span class="fas fa-search"></span> Afficher les Permissions</button>
      </div>
    </div>
  </div>
</div><br><br>
@endforeach

  @if(!empty($installs))
  <div id="modalUpdate">
    <form class="" action="/update_install_bool" method="get">
    <div class="row">
        @csrf
  @foreach ($installs as $install)
    <div class="col-sm-9 text-center">

    </div>
    <div class="col-sm-3 text-center">
      <a href="/show_partenaire?id={{$install->client_id}}" class="btn btn-info"><span class="fas fa-arrow-circle-left"></span> Retour à la liste des clubs</a><br><br>
    </div>
  <div class="col-sm-12 text-center">
    Id : {{$install->install_id}} &nbsp;&nbsp; Club : {{$install->structure}}
  </div>
  <div class="col-sm-6 text-center">
    <input type="text" name="id" value="{{$install->install_id}}" hidden>
    <input type="text" name="idCli" value="{{$install->client_id}}" hidden>
    members_read :
    @if ($install->members_read == 0)
      <input type="submit" name="members_read" class="btn btn-primary" value="Activer"><br><br>
    @else
      <input type="submit" name="members_read" class="btn btn-primary" value="Désactiver"><br><br>
    @endif
    members_write :
    @if ($install->members_write == 0)
      <input type="submit" name="members_write" class="btn btn-primary" value="Activer"><br><br>
    @else
      <input type="submit" name="members_write" class="btn btn-primary" value="Désactiver"><br><br>
    @endif
    members_add :
    @if ($install->members_add == 0)
      <input type="submit" name="members_add" class="btn btn-primary" value="Activer"><br><br>
    @else
      <input type="submit" name="members_add" class="btn btn-primary" value="Désactiver"><br><br>
    @endif
    members_product_add :
    @if ($install->members_product_add == 0)
      <input type="submit" name="members_product_add" class="btn btn-primary" value="Activer"><br><br>
    @else
      <input type="submit" name="members_product_add" class="btn btn-primary" value="Désactiver"><br><br>
    @endif
    members_payment_schedules_read :
    @if ($install->members_payment_schedules_read == 0)
      <input type="submit" name="members_payment_schedules_read" class="btn btn-primary" value="Activer"><br><br>
    @else
      <input type="submit" name="members_payment_schedules_read" class="btn btn-primary" value="Désactiver"><br><br>
    @endif
  </div>
    <div class="col-sm-6 text-center">
      members_statistiques_read :
      @if ($install->members_statistiques_read == 0)
        <input type="submit" name="members_statistiques_read" class="btn btn-primary" value="Activer"><br><br>
      @else
        <input type="submit" name="members_statistiques_read" class="btn btn-primary" value="Désactiver"><br><br>
      @endif
      members_subscription_read :
      @if ($install->members_subscription_read == 0)
        <input type="submit" name="members_subscription_read" class="btn btn-primary" value="Activer"><br><br>
      @else
        <input type="submit" name="members_subscription_read" class="btn btn-primary" value="Désactiver"><br><br>
      @endif
      members_payment_schedules_read :
      @if ($install->members_payment_schedules_read == 0)
        <input type="submit" name="members_payment_schedules_read" class="btn btn-primary" value="Activer"><br><br>
      @else
        <input type="submit" name="members_payment_schedules_read" class="btn btn-primary" value="Désactiver"><br><br>
      @endif
      payment_schedules_write :
      @if ($install->payment_schedules_write == 0)
        <input type="submit" name="payment_schedules_write" class="btn btn-primary" value="Activer"><br><br>
      @else
        <input type="submit" name="payment_schedules_write" class="btn btn-primary" value="Désactiver"><br><br>
      @endif
      payment_day_read :
      @if ($install->payment_day_read == 0)
        <input type="submit" name="payment_day_read" class="btn btn-primary" value="Activer"><br><br>
      @else
        <input type="submit" name="payment_day_read" class="btn btn-primary" value="Désactiver"><br><br>
      @endif
    </div>
  @endforeach
  </div>
  </form>
</div>
@else
<div id="modalUpdate">
</div>
@endif

</div>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function(){

    $("#add").click(function(){
      var idCli = Number($('#Idclient').val());
      var idBrh = Number($('#Idbranch').val());
      $("input[name='client_id']").val(idCli);
      $("input[name='branch_id']").val(idBrh);

      $('#modalAdd').toggle();

    });

    $("button[name='updatePerm']").click(function(){

      var stirngidBrh = $(this).attr('id');
      var idBrh = stirngidBrh.split('update');
      var idBh = idBrh[1];

      var idCli = Number($('#Idclient').val());

      $.ajax({
      method: "GET",
      url: "/show_partenaire",
      data: { id: idCli, idBh: idBrh[1] },
      success: function(data){
        $("#modalUpdate").load("/show_partenaire?id="+idCli+"&idBh="+idBh+"/" + " #modalUpdate");

      }
      });
    });

    $("#create").click(function(){
      var club = $("input[name='nom_club']").val()

      if(club == '')
      {
        alert('Nom du club obligatoire');
      }
      else {
        $('#formCreate').submit();
      }
    });

    $("#cancel").click(function(){
      $('#modalAdd').fadeOut();
    });


    $("input[name='toggleC']").click(function(){
      var stringC = $(this).attr('id');
      var selectorC= '#'+stringC
      var stringidC = stringC.split('toggleC');
      var champC = stringC.split('#');
      var idC = stringidC[1];
      var valueC = $(selectorC).val();
      var boolC = '';
      var id = Number($('#Idinstall').val());

      if(valueC === 'Activer')
      {
        boolC = 0;
      }
      else
      {
        boolC = 1;
      }
      console.log(id,boolC,champC);
      $.ajax({
      method: "GET",
      url: "/update_install_bool",
      data: { id: id, bool: boolC, champ : champC },
      success: function(data){
        location.reload();
      }
      });
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
