<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Affiche la liste des articles.
     */
    public function index()
    {
        $articles = Article::with('categorie')->get();
        return view('articles.index', compact('articles'));
    }

    /**
     * Affiche le formulaire de création d'un article (admin uniquement).
     */
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('articles.index')->with('error', 'Accès refusé.');
        }

        $categories = Categorie::all();
        return view('articles.create', compact('categories'));
    }

    /**
     * Enregistre un nouvel article (admin uniquement).
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('articles.index')->with('error', 'Accès refusé.');
        }

        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,gif,jpg,jpeg,svg,avif,webp| max:2048',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $data = $request->only(['titre', 'contenu', 'categorie_id']);
        if ($request->hasFile('image')) {
            $imageName = time(). '.' .$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        Article::create([
            'titre' => $data['titre'],
            'contenu' => $data['contenu'],
            'image' => $imageName ?? null,
            'categorie_id' => $data['categorie_id'],
        ]);
        return redirect()->route('articles.index')->with('success', 'Article créé avec succès.');
    }

    /**
     * Affiche les détails d'un article.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Affiche le formulaire d'édition d'un article (admin uniquement).
     */
    public function edit(Article $article)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('articles.index')->with('error', 'Accès refusé.');
        }

        $categories = Categorie::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Met à jour un article existant (admin uniquement).
     */
    public function update(Request $request, Article $article)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('articles.index')->with('error', 'Accès refusé.');
        }

        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required',
            'image' => 'nullable|image',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $data = $request->only(['titre', 'contenu', 'categorie_id']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
            dd($data);
        }

        $article->update($data);
        return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès.');
    }

    /**
     * Supprime un article (admin uniquement).
     */
    public function destroy(Article $article)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('articles.index')->with('error', 'Accès refusé.');
        }

        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès.');
    }
}
