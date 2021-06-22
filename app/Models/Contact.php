<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ContactCategory;

class Contact extends Model
{
    public function category()
    {
        return $this->belongsTo(ContactCategory::class,'contact_category_id');
    }
}
