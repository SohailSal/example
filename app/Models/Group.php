<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','type_id',
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\Type','type_id');
    }

    public function accounts()
    {
        return $this->hasMany('App\Models\Account', 'group_id');
    }
}
