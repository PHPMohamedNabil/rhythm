<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pages;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','category_id'];
     protected $appends = [
        'PageCount',
        'PageCountParent'
    ];

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

    public function childrenPages()
    {
        return $this->hasManyThrough(Page::class, Category::class, 'category_id');
    }

    public function finalchildrenPages()
    {
       return $this->pages()
       ->where('pages.is_history',0);
    }

    public function getPageCountAttribute()
    {
        return $this->finalchildrenPages()->count();
    }

    public function getPageCountParentAttribute()
    {
        return $this->pages()->count() + $this->childrenPages()->count();
    }
}
