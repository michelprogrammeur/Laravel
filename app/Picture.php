<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
	protected $fillable = [
    	'product_id',
    	'name',
    	'uri',
    	'status',
    	'published_at',
    ];

    public function product() {
    	return $this->belongsTo('App\Product');
    }
}
