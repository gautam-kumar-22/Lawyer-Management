<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HearingDate extends Model {

    protected $with = ['files'];
	public function case_stage() {
		return $this->belongsTo(Stage::class, 'stage_id', 'id');
	}

	public function cases() {
		return $this->belongsTo(Cases::class, 'cases_id', 'id');
	}

    public function files() {
        return $this->hasMany(Upload::class);
    }
}
