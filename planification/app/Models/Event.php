<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    
    
    use HasFactory;
    protected $table = 'events';

    public function global_week()
    {
        return $this->belongsTo(GlobalWeek::class);
    }
}
