<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'actualite';
    protected $fillable = [
        'titre', 'descriptionActualite', 'dateEvenement', 'photosActualite'
    ];
}
