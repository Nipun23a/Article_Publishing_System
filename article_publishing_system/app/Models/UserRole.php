<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $fillable = ['role_name'];

    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this -> hasMany(User::class,'user_role');
    }
}
