<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi secara massal
    protected $fillable = ['title', 'amount', 'category_id', 'type', 'date'];

    // Relasi ke model Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilterByDate($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }
}
