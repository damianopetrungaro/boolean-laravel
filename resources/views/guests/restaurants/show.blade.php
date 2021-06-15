@extends('layouts.app')

@section('page-title')
    <title>Deliveroo - {{$restaurant->name}}</title>
@endsection

@section('content')
{{-- HEADER --}}
@include('partials.header')

<div class="hero-restaurant">
    <div class="hero-info">
        <h2 class="mb-5">{{$restaurant->name}}</h2>
        <div class="votes">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
          </div>
        @foreach ($restaurant->genres as $genre)
            <p class="genre d-inline">{{$genre->type}}</p>
        @endforeach
        <p class="lead">{{$restaurant->address}}</p>
        <p class="lead">{{$restaurant->description}}</p>
    </div>
    <div class="restaurant-info">
        <div class="contacts card">
            <img src="{{asset($restaurant->path_img)}}" alt="{{$restaurant->name}}">
        </div>
        <div class="text">
            <h3 class="text-bold">Contatti: </h3>
            <h6 class=""><a class="text-decoration-none pl-1 btn btn-warning" href="tell:{{$restaurant->phone_number}}">{{$restaurant->phone_number}}</a></h6>
            <h6 class=""><a class="text-decoration-none pl-1 btn btn-warning" href="mailto:{{$restaurant->email}}">{{$restaurant->email}}</a></h6>
        </div>
    </div>
</div>


{{-- SHOW RISTORANTI GUESTS --}}
<section class="guest-bg">
    <div class="container">
        <div class="box-food justify-content-center">
            @foreach ($restaurant->foods as $food)
                <div class="box-detail col-12 col-sm-12 col-md-5">
                    <a class="text-decoration-none" href="#" @click.prevent="addCart({{$food}})">
                        <div class="text">
                            <h5>{{$food->name}}</h5>
                            <p>{{ $food->ingredients}}</p>
                            <p class="price" >{{$food->price}} €</p>
                        </div>
                        @if (!empty($food->path_img))
                            <div class="image">
                                <img class="mt-2" src="{{asset($food->path_img)}}" alt="{{$food->name}}">
                            </div>
                        @else
                        @endif
                    </a>
                </div>
            @endforeach
        </div>

        {{-- SHOW CARRELLO LATERALE --}}
        <div class="basket-content">
            <ul class="list-group basket" style="width: 300px">
                <li
                class="d-flex justify-content-between list-unstyled basket-item"
                v-for="(product, index) in shopCart" width=100>
                    <p style="width: 60%">@{{ product.name }}</p>
                    <p class="price-single-product">@{{ product.price }}</p>
                </li>


                <li v-if="finalPrice > 0" class="list-unstyled total">Total: @{{ finalPrice }} €</li>
            </ul>
            <div class="pay">
                <a :class="['d-flex justify-content-center btn', finalPrice <= 0 ? 'disabled btn-outline-secondary' : 'btn-primary']" href="{{ route('pay') }}">Vai al pagamento</a>
                <a class="d-flex justify-content-center btn text-danger" @click="puliziaCache" href="">Svuota carrello</a>
            </div>
        </div>
    </div>
</section>

{{-- Footer --}}
@include('partials.footer')
@endsection
