<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseAct extends Model {
	public $timestamps = false;
	protected $with = ['act'];
	protected $fillable = ['name', 'description'];
	

	public function act() {
		return $this->belongsTo(Act::class, 'acts_id', 'id');
	}
}
