<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\role;
class Permission extends Model
{
    use HasFactory;

    protected $casts = [
        'permissions' => 'array'
    ];
    protected $fillable = ['permissions','role_id'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
