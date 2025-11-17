<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // ----- COLE ISSO AQUI -----
    // Define quais campos podem ser preenchidos em massa (no create)
    protected $fillable = [
        'name',
        'description',
        'price',
    ];
    // ---------------------------
}