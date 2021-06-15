@extends('layouts.app')

@section('page-title')
    <title>Deliveroo - I tuoi piatti</title>
@endsection

@section('content')
{{-- HEADER --}}
@include('partials.header-admin')


<div class="container">
    @if (session('deleted'))
        <div class="alert alert-danger">
            {{ session('deleted') }} Piatto eliminato con successo.
        </div>
    @endif

    @if ($foods->isEmpty())
        <p>Non è ancora stato creato nessun piatto!</p>
    @endif


    <div class="d-flex justify-content-start mb-5">
        <a class="btn btn-light mr-3" href="{{route('admin.restaurants.index')}}">I tuoi ristoranti</a>
        <a class="btn btn-primary" href="{{route('admin.foods.create')}}">Aggiungi piatto</a>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($foods as $food)
                <div class="col-sm-12 col-md-6 col-lg-4 text-center">
                    <ul class="mt-4 list-unstyled list-group-item food-container">
                        <img class="mb-2 mt-2 food-img" src="{{asset('storage/' . $food->path_img)}}" alt="{{$food->name}}">
                        <p class="card-text pl-1"><strong>{{$food->name}}</strong></p>
                        <p class="card-text pl-1">{{$food->created_at->format('d/m/Y')}}</p>

                        <div class="d-flex justify-content-center">
                            <a class="btn btn-primary mr-1" href="{{ route('admin.foods.show', $food->slug) }}">Dettaglio</a>
                            <a class="btn btn-warning mr-1" href="{{ route('admin.foods.edit', $food->id) }}">Modifica</a>
                            <form action="{{ route('admin.foods.destroy', $food->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <input type="submit" class="btn btn-danger" value="Elimina">
                            </form>
                        </div>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>


@endsection
