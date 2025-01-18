<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategorieController;

use Illuminate\Support\Facades\Route;

// Route pour la page d'accueil
Route::get('/', function () {
    return view('welcom');
});

// Routes pour l'authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route pour le tableau de bord admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

// Routes pour les articles
Route::resource('articles', ArticleController::class);

// Routes pour les catégories
Route::resource('categories', CategorieController::class);



Route::get('/debug-category/{category}', function (\App\Models\Categorie $category) {
    return $category;
});

Route::get('categories/{id}/articles', [CategorieController::class, 'showArticles'])->name('categories.articles');

