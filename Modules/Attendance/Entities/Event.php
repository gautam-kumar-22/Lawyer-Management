<?php

namespace Modules\Attendance\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\RolePermission\Entities\Role;
class Event extends Model
{
    protected $fillable = ['title','for_whom','location','description','from_date','to_date','image','status','created_by','updated_by'];

    public function scopeActive($query)
    {
        return $query->where('status',1);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'for_whom');
    }

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->created_by = Auth::id() ?? null;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id() ?? null;
        });
    }
}
