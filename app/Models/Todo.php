<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $table = 'todos'; // Pastikan ini sesuai dengan nama tabel di database
    protected $fillable = ['user_id', 'title', 'description', 'is_done', 'category_id']; // Sesuaikan dengan kolom tabel

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
