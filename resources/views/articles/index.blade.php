@extends('template')

@section('title', 'Liste des Articles')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Liste des Articles</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($articles as $article)
            <div class="col-md-4">
                <div class="card mb-4">
                    @if($article->image)
                        <img src="{{ asset('images/' . $article->image) }}" class="card-img-top" alt="Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->titre }}</h5>
                        <p class="card-text">{{ Str::limit($article->contenu, 100) }}</p>
                        <p class="card-text"><small class="text-muted">Catégorie : {{ $article->categorie->nom }}</small></p>
                        <a href="{{ route('articles.show', $article->id) }}" class="fas fa-eye"></a>
                        @if(Auth::user() && Auth::user()->role === 'admin')
                            <a href="{{ route('articles.edit', $article->id) }}" class="fas fa-edit"></a>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="fas fa-trash-alt"></button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
