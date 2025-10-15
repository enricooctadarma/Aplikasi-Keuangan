<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi secara massal
    protected $fillable = ['name'];

    // Relasi ke model Transaction
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
