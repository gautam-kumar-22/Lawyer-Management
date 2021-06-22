<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\Inventory\Entities\WareHouse;
use Modules\Inventory\Entities\ShowRoom;
use Modules\Setup\Entities\Department;
// use Modules\Setup\Entities\IntroPrefix;

class Staff extends Model
{
    protected $table = 'staffs';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
