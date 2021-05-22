@extends('layouts.app')

@section('page-title')
    <title>Deliveroo - {{$restaurant->name}}</title>
@endsection

@section('content')
{{-- HEADER --}}
@include('partials.header-admin')

    <div class="container text-center">
        <h3 class="pb-4 text-center">Riepilogo ristorante</h3>
        <div class="auth-container mt-4">
            <li class="list-unstyled list-group-item">
                <div class="content">
                    <h4 class="pb-2">{{$restaurant->name}}</h4>
                    <p>Indirizzo: {{$restaurant->address}}</p>
                    <p>P.Iva: {{$restaurant->vat_number}}</p>
                    <div class="d-flex justify-content-center">
                        <p class="pr-2">Tipologia ristorante:<br></p>
                        @foreach($restaurant->genres as $genre)

                            <p class="d-flex align-item-center pr-1">{{$genre->type}} |</p>
                        @endforeach
                    </div>
                    {{-- <p>{{$restaurant->description}}</p> --}}
                </div>

                <div class="image">
                    <img width="250" src="{{asset('storage/' . $restaurant->path_img)}}" alt="">
                </div>

                <div class="button mt-2 text-center d-flex justify-content-center">
                    <a class="btn btn-light mr-3" href="{{route('admin.restaurants.index')}}">I tuoi ristoranti</a>
                    <a class="btn btn-primary" href="{{route('admin.foods.index')}}">I tuoi piatti</a>
                </div>
            </li>
            {{-- <p>{{$restaurant->created_at->diffForHumans()}}</p> --}}
        </div>
    </div>
@endsection
