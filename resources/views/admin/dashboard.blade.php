@extends('template')

@section('title', 'Tableau de Bord Admin')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Tableau de Bord Administrateur</h1>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Articles</h5>
                    <p class="card-text">{{ $articles }} Articles</p>
                    <a href="{{ route('articles.index') }}" class="btn btn-primary">Gérer les Articles</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Catégories</h5>
                    <p class="card-text">{{ $categories }} Catégories</p>
                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Gérer les Catégories</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
