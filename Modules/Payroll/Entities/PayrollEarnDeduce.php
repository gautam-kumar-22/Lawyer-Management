<?php

namespace Modules\Payroll\Entities;

use Illuminate\Database\Eloquent\Model;
use Auth;

class PayrollEarnDeduce extends Model
{
    protected $table = "payroll_earn_deducs";
    protected $guarded = ['id'];
    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }
    public static function boot()
    {
        parent::boot();
        static::saving(function ($brand) {
            $brand->created_by = Auth::user()->id ?? null;
        });

        static::updating(function ($brand) {
            $brand->updated_by = Auth::user()->id ?? null;
        });
    }
}
