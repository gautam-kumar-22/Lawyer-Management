<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;

class SelectController extends Controller {
	
	public function state(Request $request) {
		$country = $request->value;
		$state = State::where('country_id', $country)->get();
		return $state;
	}

	public function city(Request $request) {
		$state = $request->value;
		$city = City::where('state_id', $state)->get();
		return $city;
	}

	public function court(Request $request) {
		$court_category_id = $request->value;
		$court = Court::where('court_category_id', $court_category_id)->get();
		return $court;
	}
}