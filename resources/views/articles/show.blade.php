@extends('template')

@section('title', 'Détails de l\'Article')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">{{ $article->titre }}</h1>
    @if($article->image)
        <img src="{{ asset('images/' . $article->image) }}" alt="{{ $article->titre }}" class="img-fluid my-3">
    @endif
    <p>{{ $article->contenu }}</p>
    <p><strong>Catégorie :</strong> {{ $article->categorie->nom }}</p>
    <a href="{{ route('articles.index') }}" class="fas fa-arrow-left">retour à la liste</a>
</div>
@endsection
