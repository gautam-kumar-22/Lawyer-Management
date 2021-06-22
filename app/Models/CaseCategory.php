<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed description
 * @property mixed name
 * @method static find(int $id)
 * @method static findOrFail(int $id)
 */
class CaseCategory extends Model
{
    protected $table = 'case_categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description'];
}
