@extends('layouts.app')

@section('page-title')
    <title>Deliveroo - Modifica {{$restaurant->name}}</title>
@endsection

@section('content')
{{-- HEADER --}}
@include('partials.header-admin')

    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ Route('admin.restaurants.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            {{-- NAME --}}
            <div class="form-group">
                <label for="name">Nome</label>
                <input class="form-control" type="text" name="name" value="{{old('name', $restaurant->name)}}" id="name">
            </div>
            {{-- EMAIL --}}
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" value="{{old('email', $restaurant->email)}}" id="email">
            </div>
            {{-- PHONE_NUMBER --}}
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input class="form-control" type="text" name="phone_number" value="{{old('phone_number', $restaurant->phone_number)}}" id="phone_number">
            </div>
            {{-- VAT_NUMBER --}}
            <div class="form-group">
                <label for="vat_number">Vat Number</label>
                <input class="form-control" type="text" name="vat_number" value="{{old('vat_number', $restaurant->vat_number)}}" id="vat_number">
            </div>
            {{-- ADDRESS --}}
            <div class="form-group">
                <label for="address">Address</label>
                <input class="form-control" type="text" name="address" value="{{old('address', $restaurant->address)}}" id="address">
            </div>
            {{-- DESCRIPTION --}}
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" type="text" name="description" id="description"> {{old('description', $restaurant->description)}} </textarea>
            </div>
            {{-- IMAGE --}}
            <div class="form-group">
                <label for="path_img">Add image</label>
                @isset($restaurant->path_img)
                    <div class="wrap-image">
                        <img width="250" src="{{ asset('storage/' . $restaurant->path_img) }}" alt="">
                    </div>
                    <h5>Change img</h5>
                @endisset
                <input class="form-control" type="file" name="path_img" id="path_img" accept="image/*">
            </div>
            
            <div class="form-group">
                @foreach ($genres as $genre)
                    <div class="form-check">
                        <input class="from-check-input" type="checkbox" name="genres[]" id="genre-{{$genre->id}}" value="{{$genre->id}}">
                        <label for="genre-{{$genre->id}}"> {{$genre->type}} </label>
                    </div>
                @endforeach
            </div>
            
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Update">
            </div>
        </form>

    </div>
@endsection