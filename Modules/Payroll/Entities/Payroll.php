<?php

namespace Modules\Payroll\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Staff;
use Modules\RolePermission\Entities\Role;
use Auth;

class Payroll extends Model
{
    protected $table = "payrolls";
    protected $guarded = ['id'];
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function payroll_earn_deducs()
    {
        return $this->hasMany(PayrollEarnDeduce::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
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

    public static function getPayrollDetails($staff_id, $payroll_month, $payroll_year){
		try {
			$getPayrollDetails = Payroll::with('staff.user')
								->where('staff_id', $staff_id)
								->where('payroll_month', $payroll_month)
								->where('payroll_year', $payroll_year)
								->first();

			if(isset($getPayrollDetails)){
				return $getPayrollDetails;
			}
			else{
				return false;
			}
		} catch (\Exception $e) {
			return false;
		}
    }
}
