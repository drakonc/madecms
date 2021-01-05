<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PGallery extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'product_gallery';
    protected $hidden = ['created_at','updated_at'];
}
