<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'products';
    protected $hidden = ['created_at','updated_at'];

    public function cat(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function getGallery(){
        return $this->hasMany(PGallery::class,'product_id','id');
    }
}
