<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategorieController extends Controller
{
    /**
     * Affiche la liste des catégories.
     */
    public function index()
    {
        $categories = Categorie::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Affiche le formulaire de création d'une catégorie.
     */
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('categories.index')->with('error', 'Accès refusé.');
        }

        return view('categories.create');
    }

    /**
     * Enregistre une nouvelle catégorie.
     */
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('categories.index')->with('error', 'Accès refusé.');
        }

        $request->validate([
            'nom' => 'required|string|max:255|unique:categories',
        ]);

        Categorie::create([
            'nom' => $request->nom,
        ]);

        return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Affiche le formulaire d'édition d'une catégorie.
     */
    public function edit($id)
    {
        $categorie = Categorie::findOrFail($id);

        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('categories.index')->with('error', 'Accès refusé.');
        }

        return view('categories.edit', compact('categorie'));
    }

    /**
     * Met à jour une catégorie existante.
     */
    public function update(Request $request, $id)
    {
        $categorie = Categorie::findOrFail($id);

        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('categories.index')->with('error', 'Accès refusé.');
        }

        $request->validate([
            'nom' => 'required|string|max:255|unique:categories,nom,' . $categorie->id,
        ]);

        $categorie->update([
            'nom' => $request->nom,
        ]);

        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Supprime une catégorie existante.
     */
    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);

        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('categories.index')->with('error', 'Accès refusé.');
        }

        $categorie->delete();

        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }
    /**
 * Affiche les articles liés à une catégorie spécifique.
 */
public function showArticles($id)
{
    $categorie = Categorie::with('articles')->findOrFail($id);

    return view('categories.articles', [
        'categorie' => $categorie,
        'articles' => $categorie->articles,
    ]);
}

}
