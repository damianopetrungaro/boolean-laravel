@extends('layouts.app')

@section('page-title')
    <title>Deliveroo - Ristoranti</title>
@endsection

@section('content')
{{-- HEADER --}}
@include('partials.header-admin')
<div class="table-responsive-sm">
    <div class="container">
        {{-- Banner verifica deleted --}}
        @if (session('deleted'))
        <div class="alert alert-danger">
            {{ session('deleted') }} Ristorante eliminato con successo!
        </div>
        @endif

        {{-- Check ristorante se presenti --}}
        @if ($restaurants->isEmpty())
            <p>Non è ancora stato creato nessun ristorante!</p>
        @endif

        {{-- Index ristoranti creati --}}
        <ul class="auth-container">
            <table class="table">
                <thead class="bg">
                    <tr>
                        <th>ID</th>
                        <th scope="col">Vetrina</th>
                        <th scope="col">Nome ristorante</th>
                        <th scope="col">Creato</th>
                        <th scope="col">Genere ristorante</th>
                        <th scope="col">|</th>
                        <th colspan="10">Azioni</th>
                        {{-- <th colspan=“13”></th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($restaurants as $restaurant)
                        <tr>
                            <th scope="row">{{$restaurant->id}}</th>
                            <td><img width="80" src="{{asset('storage/' . $restaurant->path_img)}}" alt=""></td>
                            <td>{{$restaurant->name}}</td>
                            <td>{{$restaurant->created_at->format('d/m/Y')}}</td>
                            <td>
                                @foreach($restaurant->genres as $genre)
                                    {{$genre->type}}
                                @endforeach
                            </td>
                            <td> <a class="btn btn-primary" href="{{ route('admin.restaurants.show', $restaurant->slug) }}">Mostra</a></td>
                            <td> <a class="btn btn-warning" href="{{ route('admin.restaurants.edit', $restaurant->id) }}">Modifica</a></td>
                            <td>
                                <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <input type="submit" class="btn btn-danger" value="Elimina">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </ul>
    </div>
</div>
@endsection
