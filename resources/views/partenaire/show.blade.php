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
          {{ $client->client_id }}<br><br>
          {{ $client->client_name }}<br><br>
          {{ $client->full_description }}<br><br>
        </div>
        <div class="col-sm-4 text-center">
          {{ $client->url }}<br><br>
          {{ $client->dpo }}<br><br>
          {{ $client->technical_contact }}<br><br>
          {{ $client->commercial_contact }}<br><br>
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
            <button type="submit" class="btn btn-secondary">Désactiver</button><br><br>
          @else
            Etat : Inactif
            <button type="submit" class="btn btn-primary">Activer</button><br><br>
          @endif
        @endforeach
      </div>
        <div class="col-sm-4 text-center">

        </div>
        <div class="col-sm-4 text-center">
          <button class="btn btn-info">Afficher les permissions</button><br><br>
          <button class="btn btn-success">Ajouter</button>
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
        id client : {{ $grant->client_id }}
        install id : {{ $grant->install_id }}
        branch id : {{ $grant->branch_id }}<br><br>
        @if ($grant->active == 0)
          Etat : Actif
          <button type="submit" class="btn btn-secondary">Désactiver</button>
        @else
          Etat : Inactif
          <button type="submit" class="btn btn-primary">Activer</button>
        @endif
      </div>
        <div class="col-sm-4 text-center">

        </div>
        <div class="col-sm-4 text-center">

        </div>
      @endforeach
    </div>
  </div>
</div>

<br><br>

<div class="card">
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

@endsection
