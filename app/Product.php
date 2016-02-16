<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'category_id',
    	'title',
    	'abstract',
    	'status',
    	'price',
    	'content',
    	'quantity',
    	'published_at',
        'slug',
    ];

    public function category() {
    	return $this->belongsTo('App\Category');
    }

    public function picture() {
    	return $this->hasOne('App\Picture');
    }

    public function tags() {
    	return $this->belongsToMany('App\Tag');
    }
}
