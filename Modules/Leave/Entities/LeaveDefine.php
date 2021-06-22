<?php

namespace Modules\Leave\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\RolePermission\Entities\Role;
use Modules\Leave\Entities\LeaveType;

class LeaveDefine extends Model
{
    protected $table = "leave_defines";
    protected $guarded = ['id'];

    public function role()
    {
        return $this->belongsTo(Role::class, "role_id");
    }

    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class);
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
