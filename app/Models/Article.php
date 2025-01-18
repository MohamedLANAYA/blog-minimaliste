<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'contenu', 'image', 'categorie_id'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
