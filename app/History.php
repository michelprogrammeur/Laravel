<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class History extends Model
{
	protected $fillable = [
    	'product_id',
    	'quantity',
	];

	public function setCommandAtAttribute($value) {
		$this->attributes['commande_at'] = Carbon('now');
	}

    public function product() {
    	return $this->belongsTo('App\Product');
    }
}
