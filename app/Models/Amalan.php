<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Amalan.php
class Amalan extends Model
{
    // use HasFactory;

    protected $fillable = ['judul', 'deskripsi', 'link'];

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'amalan_kategori');
    }
}

