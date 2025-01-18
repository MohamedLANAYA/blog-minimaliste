<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Affiche le tableau de bord de l'admin.
     */
    public function index()
    {
        // Vérifie si l'utilisateur est un admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('articles.index')->with('error', 'Accès refusé.');
        }

        // Compte les articles et les catégories
        $articles = Article::count();
        $categories = Categorie::count();

        // Retourne la vue du tableau de bord admin
        return view('admin.dashboard', compact('articles', 'categories'));
    }
}
