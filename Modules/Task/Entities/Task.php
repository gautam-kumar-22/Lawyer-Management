<?php

namespace Modules\Task\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\User;
use App\Models\Stage;
use App\Models\Cases;
class Task extends Model
{
    protected $fillable = [];

    public function case()
    {
        return $this->belongsTo(Cases::class);
    }


    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }

}
