<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatchUp extends Model
{
    protected $table = 'caughtupabsences';
    use HasFactory;
    public function absence()
    {
        return $this->morphOne(Absence::class,'absenceable');
    }
    
}
// $InSessions = Session::where('session_date', $date)->where('timing_id', $timing_id)->pluck('room_id');
        // $InAdditionals = Additional::where('additional_date', $date)->where('timing_id', $timing_id)->pluck('room_id')->toArray();
        // $InCatchUp = CatchUp::where('catchup_date', $date)->where('timing_id', $timing_id)->pluck('room_id')->toArray();
        // $inControls = Control::where('control_date', $date)->where('timing_id', $timing_id)->pluck('room_id')->toArray();
        // $OccupiedRooms = [];
        // array_push($OccupiedRooms, $InSessions);
        // // array_push($OccupiedRooms, $InCatchUp);
        // // array_push($OccupiedRooms, $inControls);
        // // array_push($OccupiedRooms, $InAdditionals);
        // // $available = Room::whereNotIn('id', $OccupiedRooms)->get();
        // $available = Room::whereNotIn('id', $OccupiedRooms)->pluck('id')->toArray();
        // \Log::info('Occupied Rooms: ' . print_r($OccupiedRooms, true));
        // \Log::info('Available Rooms: ' . print_r($available, true));