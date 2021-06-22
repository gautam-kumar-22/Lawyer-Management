<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed description
 * @property mixed name
 * @method static find(int $id)
 * @method static findOrFail(int $id)
 */
class CourtCategory extends Model {
	protected $table = 'court_categories';
	protected $primaryKey = 'id';
	protected $fillable = ['name', 'description'];

	public function courts() {
		return $this->hasMany(Court::class);
	}

}
