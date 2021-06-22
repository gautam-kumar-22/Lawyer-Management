<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{

    protected $fillable = ['key','value'];
    
   
}
