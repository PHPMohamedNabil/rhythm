<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Wall extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','attachment','is_important','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
