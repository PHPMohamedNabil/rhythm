<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\User;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = ['slug','title','short_description','long_description','content','published','category_id','refer_to','user_id','editor_id','publisher_id'];


    public function history()
    {
        return $this->hasMany(Page::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function scopeSearchTable($query)
    {
        return $query->select(['id','title','created_at','updated_at']);
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function editor()
    {
       return $this->belongsTo(User::class,'editor_id');
    }

    public function publisher()
    {
       return $this->belongsTo(User::class,'publisher_id');
    }

}
