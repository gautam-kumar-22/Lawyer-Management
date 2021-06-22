<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model {
	protected $table = 'cases';
	protected $primaryKey = 'id';
	protected $fillable = ['name', 'description'];

	protected $with = ['files'];

	public function acts() {
		return $this->hasMany(CaseAct::class);
	}

	public function plaintiff_client() {
		return $this->belongsTo(Client::class, 'plaintiff', 'id');
	}

	public function case_stage() {
		return $this->belongsTo(Stage::class, 'stage_id', 'id');
	}

	public function client_category() {
		return $this->belongsTo(ClientCategory::class);
	}

	public function case_category() {
		return $this->belongsTo(CaseCategory::class);
	}

	public function opposite_client() {
		return $this->belongsTo(Client::class, 'opposite', 'id');
	}

	public function court() {
		return $this->belongsTo(Court::class);
	}

	public function lawyer() {
		return $this->belongsTo(Lawyer::class);
	}

	public function hearing_dates() {
		return $this->hasMany(HearingDate::class)->orderBy('date', 'desc');
	}

    public function files() {
        return $this->hasMany(Upload::class, 'case_id')->whereNull('hearing_date_id');
    }

    public function allFiles() {
        return $this->hasMany(Upload::class, 'case_id');
    }

}
