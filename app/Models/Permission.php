<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'permissions';

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }
}
