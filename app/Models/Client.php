<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

	protected $table = 'clients';
	protected $primaryKey = 'id';
	protected $fillable = ['country_id', 'state_id', 'city_id','client_category_id','email', 'mobile', 'gender', 'address', 'name', 'description'];

	public function country() {
		return $this->belongsTo(Country::class);
	}

	public function state() {
		return $this->belongsTo(State::class);
	}

	public function city() {
		return $this->belongsTo(City::class);
	}

	public function category()
    {
        return $this->belongsTo(ClientCategory::class,'client_category_id');
    }
}
