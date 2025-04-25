<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Kategori.php
class Kategori extends Model
{
    // use HasFactory;

    protected $fillable = ['nama'];

    public function amalans()
    {
        return $this->belongsToMany(Amalan::class, 'amalan_kategori');
    }
}

