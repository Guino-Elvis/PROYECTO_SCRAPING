<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'stock', 'state', 'category_id', 'user_id'];

    //Relación 1 a * inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Relación 1 a 1 polimorfica
    //Se pasa la clase y el metodo definido
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
