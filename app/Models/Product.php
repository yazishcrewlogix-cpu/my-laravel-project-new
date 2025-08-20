<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'user_id'];

    // Each product belongs to a user
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
/*public function products()
{
    return $this->belongsToMany(Products::class);
}*/
}

