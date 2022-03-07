<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pages;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','category_id'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function childrenCategories()
    {
       return $this->hasMany(Category::class)->with('categories');
    }
    
    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
