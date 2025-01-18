@extends('template')

@section('title', 'Liste des Catégories')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Liste des Catégories</h1>
    
    {{-- Affichage des messages de succès --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    {{-- Vérification si des catégories existent --}}
    @if($categories->isEmpty())
        <p class="text-center">Aucune catégorie trouvée.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $categorie)
                    <tr>
                        {{-- Nom de la catégorie avec lien vers ses articles --}}
                        <td>
                            <a href="{{ route('categories.articles', $categorie->id) }}">{{ $categorie->nom }}</a>
                        </td>

                        {{-- Actions (Modifier / Supprimer) visibles uniquement pour l'admin --}}
                        <td>
                            @auth
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('categories.edit', $categorie->id) }}" class="fas fa-edit"></a>
                                    <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="fas fa-trash-alt"></button>
                                    </form>
                                @endif
                            @endauth
                        </td>
                        
                        
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
