<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Todo; // ✅ penting agar relasi dikenal

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
    ];

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}
