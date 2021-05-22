@extends('layouts.app')

@section('page-title')
    <title>Deliveroo - Homepage</title>
@endsection

@section('content')
{{-- HEADER --}}
@include('partials.header')

<div class="jumbotron-fluid text-center">
<img src="../img/asset/payment/payed.png" alt="">
  <h1 class="display-4 mt-4">Pagamento avvenuto con successo!</h1>
  <p class="lead">Grazie per aver acquistato da noi, stiamo elaborando l'ordine...</p>
  <hr class="my-4">
  <a class="btn btn-primary btn-lg" href="{{route('home')}}" role="button">Torna alla home</a>
</div>


{{-- Footer --}}
@include('partials.footer')
@endsection
