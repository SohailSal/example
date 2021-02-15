<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'roles';

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

    public function allowTo($permission)
    {
        return $this->permissions()->attach($permission);
    }

    public function disallowTo($permission)
    {
        return $this->permissions()->detach($permission);
    }
}
