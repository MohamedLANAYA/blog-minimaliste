@extends('template')

@section('title', 'Ajouter une Catégorie')

@section('content')
<div class="container mt-5">
    <h1>Ajouter une Catégorie</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
