@extends('layouts.app')

@section('page-title')
    <title>Deliveroo - Modifica {{$food->name}}</title>
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

        <form action="{{ Route('admin.foods.update', $food->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            {{-- NAME --}}
            <div class="form-group">
                <label for="name">Nome</label>
                <input class="form-control" type="text" name="name" value="{{old('name', $food->name)}}" id="name">
            </div>
            {{-- DESCRIPTION --}}
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" type="text" name="description" id="description"> {{old('description', $food->description)}} </textarea>
            </div>
            {{-- INGREDIENTS --}}
            <div class="form-group">
                <label for="ingredients">Ingredients</label>
                <input class="form-control" type="text" name="ingredients" value="{{old('ingredients', $food->ingredients)}}" id="ingredients">
            </div>
            {{-- PRICE --}}
            <div class="form-group">
                <label for="price">Price</label>
                <input class="form-control" type="text" name="price" value="{{old('price', $food->price)}}" id="price">
            </div>
            {{-- VISIBILITY --}}
            <div class="form-group">
                <label for="visibility">Visibility</label>

                    <select name="visibility" id="visibility">
                        <option value="si" {{old('visibility') == 'si' ? 'selected' : ''}}>Si</option>
                        <option value="no" {{old('visibility') == 'no' ? 'selected' : ''}}>No</option>
                    </select>
            </div>

            {{-- IMAGE --}}
            <div class="form-group">
                <label for="path_img">Add image</label>
                @isset($food->path_img)
                    <div class="wrap-image">
                        <img width="250" src="{{ asset('storage/' . $food->path_img) }}" alt="">
                    </div>
                    <h5>Change img</h5>
                @endisset
                <input class="form-control" type="file" name="path_img" id="path_img" accept="image/*">
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Update">
            </div>
        </form>

    </div>
@endsection
