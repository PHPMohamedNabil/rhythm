<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;
use App\Models\User;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name','description'];


    public function permission()
    {
       return  $this->hasOne(Permission::class);
    }

    public function user()
    {
       return $this->hasOne(User::class);
    }
}
