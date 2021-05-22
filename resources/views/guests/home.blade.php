@extends('layouts.app')

@section('page-title')
    <title>Deliveroo - Homepage</title>
@endsection

@section('content')
{{-- HEADER --}}
@include('partials.header')

{{-- Main --}}
<div class="image-bg">
    <section class="container">
        <div class="hero">
            <div class="content col-sm-12 col-md-8 col-lg-5">
                <h2 class="title">I piatti che ami, a domicilio.</h2>
                {{-- Barra di ricerca --}}
                <div class="search">
                    <p>Cerca i tuoi ristoranti preferiti</p>
                    <input
                    class="imput-group"
                    type="text"
                    placeholder="Cerca ristorante" v-model='research' @keyup="searchRestaurant">
                    <i class="fas fa-location-arrow"></i>
                    <a href="#" click.prevent=""
                    class="btn btn-primary"
                    @click="searchRestaurant">Cerca</a>
                    <small class="lable-p">
                        <a class="nav-link" href="{{ route('login') }}"> 
                            {{ __('Accedi') }}
                        </a>
                        per gestire i tuoi ristoranti.
                    </small>
                </div>
            </div>
        </div>
    </section>
</div>



    {{-- Lista generi --}}
    <div class="genre container d-flex justify-content-center mt-4 mb-3">
        <ul class="list-group list-group-horizontal-sm">
            <li class="list-unstyled mr-2" role="button" v-for="genre in showGenres" @click="filterGenres(genre.type)">
                <img :src="'./img/asset/genres/' + genre.img + '.png'" :alt="genre.type">
                <span class="text-uppercase font-weight-bold"> @{{genre.type}}</span>
            </li>
        </ul>
    </div>
    <div class="genre-selected text-center">
        <p v-if="genresFiter.length > 0" class="lead text-secondary">I generi selezionati sono: </p>
        <span role="button" class="text-uppercase badge badge-pill badge-dark h5 ml-1 p-1 pl-2 pr-2" v-for="(genre, index) in genresFiter" @click="genreSelected(index)"> @{{genre}} </span>
    </div>

    {{-- Lista generi responsive --}}
    <div class="genre-responsive mb-4">
        <i class="fas fa-bars" @click="showGenre = !showGenre"></i>
        <div class="drop-down" v-if="showGenre">
            <ul>
                <li v-for="genre in showGenres" @click="filterGenres(genre.type)">
                    <span class="text-uppercase font-weight-bold text-secondary"> @{{genre.type}}</span>
                </li>
            </ul>
        </div>
    </div>

    {{-- Controlo nessun ristorante presente --}}
    @if ($restaurants->isEmpty())
       <p class="no-restaurant container">Nessun ristorante presente nella tua ricerca</p>
    @endif

    <h2 class="text-center pt-3 pb-3 title-col-accent" style="font-weight: 700">I ristoranti nella tua zona</h2>
    <div class="container">
        <div class="hero row restaurants-list">
            <div class="col-sm mb-5" v-for="(restaurant, index) in allRestaurants" v-if="restaurant.visible == 1">
                <a class="text-decoration-none" :href=`{{ route('restaurants.show', '') }}/${restaurant.slug}`>
                    <div class="card text-center" style="width: 15rem">
                        <img :src="'../storage/' + restaurant.path_img" class="card-img-top" :alt="restaurant.name">
                        <div class="card-body">
                            <h4 class="card-title">@{{restaurant.name}}</h4>
                            <p class="card-text description">@{{(restaurant.description)}}</p>
                            <small>Consegna gratuita</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="no-restaurants text-center" v-if="allRestaurants.length <= 0">
            <h4 class="title mt-4 mb-5 text-uppercase text-secondary">Non ci sono ristoranti che corrispondono alla ricerca</h4>
        </div>
    </div>

    {{-- Selezione di deliveroo --}}
    <section class="selection container mt-5">
        <h2 class="mb-4">La selezione di deliveroo</h2>
        <div class="content">
            <div class="comfort-food">
                <div class="content-img">
                    <h3>Comfort food</h3>
                </div>
                <p>I grandi classici che scaldano il cuore, perfetti in ogni momento.</p>
                <a href="#" click.prevent="">Scopri Comfort food</a>
            </div>
            <div class="dolci-dessert">
                <div class="content-img">
                    <h3>Dolci e dessert</h3>
                </div>
                <p>Dolci piaceri per rendere la gionata ancora più gustosa.</p>
                <a href="#" click.prevent="">Scopri Dolci e dessert</a>
            </div>
            <div class="perfect-to-share">
                <div class="content-img">
                    <h3>Perfetti da condividere</h3>
                </div>
                <p>Serve una scusa per stare insieme? Ordina dai ristoranti che trasformeranno la tua serata in una vera festa.</p>
                <a href="#" click.prevent="">Scopri perfetti da condividere</a>
            </div>
            <div class="exclusive-deliveroo">
                <div class="content-img">
                    <h3>Esclusiva Deliveroo</h3>
                </div>
                <p>I più famosi, i più buoni, i preferiti. Quelli che trovi solo su Deliveroo.</p>
                <a href="#" click.prevent="">Scopri Esclusiva Deliveroo</a>
            </div>
        </div>
    </section>

    {{-- Section news --}}
    <section class="news container mt-5">
        <h2 class="mb-4">Novità dalla nostra cucina</h2>
        <div class="work-news card mb-5">
            <div class="img-container">
                <img src="{{asset('img/asset/news-work-sushi.jpg')}}" alt="News Work">
            </div>
            <div class="text-container news">
                <h4>Deliveroo per le Aziende</h4>
                <p>Clienti o colleghi affamati? il nostro team Corporate ti può aiutare.</p>
                <a href="#" click.prevent=""  class="btn btn-primary">Contattaci</a>
            </div>
        </div>
        <div class="work-app card mb-5">
            <div class="text-container app">
                <h4>Hai già la nostra app?</h4>
                <p>Scaricala ora - disponibile su Apple store e Google Play!</p>
                <a href="#" click.prevent="">
                    <img height="40" src="{{ asset('img/asset/app-store.png') }}"  alt="App-store">
                </a>
                <a href="#" click.prevent="">
                    <img height="40" src="{{ asset('img/asset/google-play.png') }}"  alt="Google-play">
                </a>
            </div>
            <div class="img-container">
                <img src="{{asset('img/asset/app.jpg')}}" alt="News Work">
            </div>
        </div>
    </section>

    {{-- Section work with Deliveroo --}}
    <section class="work container mb-5">
        <h2>Lavora con Deliveroo</h2>
        <div class="row row-cols-1 row-cols-md-3">
            <div class="col mb-4">
                <div class="card">
                    <img src="{{ asset('img/asset/rider.jpg') }}" alt="Lavora con noi">
                <div class="card-body rider">
                    <h5 class="card-title">Rider</h5>
                    <p class="card-text">Diventa un rider: flessibilità, ottimi guadagni e un mondo di vantaggi per te.</p>
                    <a href="#" click.prevent="" class="btn btn-primary">Unisciti a noi</a>
                </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card">
                    <img src="{{ asset('img/asset/ristoranti.jpg') }}" alt="Diventa partner">
                <div class="card-body ristoranti">
                    <h5 class="card-title">Ristoranti</h5>
                    <p class="card-text">Diventa partner di Deliveroo e raggiungi sempre più clienti. Ci occupiamo noi della consegna, così che la tua unica preoccupazione sia continuare a preparare il miglior cibo.</p>
                    <a href="#" click.prevent="" class="btn btn-primary">Diventa nostro partner</a>
                </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card">
                    <img src="{{ asset('img/asset/lavoro.jpg') }}" alt="Lavora con noi">
                    <div class="card-body lavoro">
                        <h5 class="card-title">Lavora con noi</h5>
                        <p class="card-text">La nostra missione è trasformare il modo in cui le persone mangiano. È un obiettivo ambizioso, come noi, e ci servono persone che ci aiutino a raggiungerlo.</p>
                        <a href="#" click.prevent="" class="btn btn-primary">Scopri di più</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Footer --}}
@include('partials.footer')
@endsection
