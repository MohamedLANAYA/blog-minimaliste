@extends('template')

@section('title', 'Articles dans ' . $categorie->nom)

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Articles dans la catégorie : {{ $categorie->nom }}</h1>
    @if($articles->isEmpty())
        <p class="text-center">Aucun article trouvé dans cette catégorie.</p>
    @else
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-4">
                    <div class="card mb-4">
                        @if($article->image)
                            <img src="{{ asset('images/' . $article->image) }}" class="card-img-top" alt="{{ $article->titre }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->titre }}</h5>
                            <p class="card-text">{{ Str::limit($article->contenu, 100) }}</p>
                            <a href="{{ route('articles.show', $article->id) }}" class="fas fa-eye"></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
