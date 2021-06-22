<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

}
