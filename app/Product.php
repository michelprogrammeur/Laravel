<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function setPublishedAtAttribute($value) {
        
        $this->attributes['published_at'] = (!empty($value))? Carbon::now() : '0000-00-00 00:00:00';
        
    }

    public function setSlugAttribute($value) {
        $this->attributes['slug'] = (empty($value))? str_slug($this->title) : str_slug($value);
    }

    public function hasTag($id) {

        foreach ($this->tags as $tag) {
            if($tag->id == $id) return true;
        }
        return false;
    }

    public function setCategoryIdAttribute($value) {
        $this->attributes['category_id'] = ($value == 0) ? null : $value;
    }

    /*public function setTitleAttribute($value) {
        $this->attributes['title'] = 'je suis une sauccisse';
    }*/
    public function getTitleAttribute($value) {
        return ucfirst($value);
    }

}
