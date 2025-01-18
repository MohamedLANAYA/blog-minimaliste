@extends('template')

@section('title', 'Modifier une Catégorie')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Modifier une Catégorie</h1>
    <form method="POST" action="{{ route('categories.update', $categorie->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nom" class="form-label">Nom de la Catégorie</label>
            <input type="text" id="nom" name="nom" value="{{ $categorie->nom }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
