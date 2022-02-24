<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'module', 'object_id' ];
    protected $table = 'user_favorites';
    protected $hidden = ['created_at','updated_at'];

}
