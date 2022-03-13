<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Question extends Model
{

    use HasFactory;

    protected $fillable = ['title','answer_title','answer','attachment','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
