<?php

namespace App;

use App\Notifications\PasswordResetNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Attendance\Entities\Attendance;
use Modules\Leave\Entities\ApplyLeave;
use Modules\Leave\Entities\LeaveDefine;
use Modules\RolePermission\Entities\Role;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'username', 'email', 'password', 'role_id', 'status', 'avatar',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function employee() {
		return $this->hasOne('App\Models\Employee\Employee');
	}

	public function getProfile() {

		$profile = $this->employee;

		return $profile;
	}

	public function role() {
		return $this->belongsTo(Role::class);
	}

	public function attendances() {
		return $this->hasMany(Attendance::class);
	}

	public function staff() {
		return $this->hasOne(Staff::class);
	}

	public function leaves() {
		return $this->hasMany(ApplyLeave::class)->CarryForward();
	}

	public function leaveDefines() {
		return $this->hasMany(LeaveDefine::class, 'role_id', 'role_id');
	}

	public function sendPasswordResetNotification($token) {
		$this->notify(new PasswordResetNotification($token));
	}

}
