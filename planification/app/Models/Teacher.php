<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    
    public function scopeSearch($query)
    {
        $q = request('q');
        $query->where('first_name', 'like', "%$q%")
            ->orWhere('Last_name', 'like', "%$q%");
    }

    public function modules()// 
    {
        return $this->belongsToMany(Module::class,'teachers_modules');
    }
    public function absences()//Sure
    {
        return $this->hasManyThrough(Absence::class,Session::class);
    }
    public function nb_absences()//Sure
    {
        return $this->hasManyThrough(Absence::class,Session::class)->count();
    }
    public function department()//true
    {
        return $this->belongsTo(Department::class);
    }
    public function sessions()//true 
    {
        return $this->hasMany(Session::class);
    }
    public function nb_Cours_S1()
    {
        return $this->hasMany(Session::class, 'teacher_id')
                    ->where('session_type', 'Cour')
                    ->whereHas('week', function ($query) {
                        $query->where('semester', '1');
                    });
    }
    public function nb_Cours_S2()
    {
        return $this->hasMany(Session::class, 'teacher_id')
                    ->where('session_type', 'Cour')
                    ->whereHas('week', function ($query) {
                        $query->where('semester', '2');
                    });
    }
    public function nb_Tds_S1()
    {
        return $this->hasMany(Session::class, 'teacher_id')
                    ->where('session_type', 'Td')
                    ->whereHas('week', function ($query) {
                        $query->where('semester', '1');
                    });
    }
    public function Tds_S2()
    {
        return $this->hasMany(Session::class, 'teacher_id')
                    ->where('session_type', 'Td')
                    ->whereHas('week', function ($query) {
                        $query->where('semester', '2');
                    });
    }
    public function Tps_S1()
    {
        return $this->hasMany(Session::class, 'teacher_id')
                    ->where('session_type', 'Tp')
                    ->whereHas('week', function ($query) {
                        $query->where('semester', '1');
                    });
    }
    public function Tps_S2()
    {
        return $this->hasMany(Session::class, 'teacher_id')
                    ->where('session_type', 'Tp')
                    ->whereHas('week', function ($query) {
                        $query->where('semester', '2');
                    });
    }
}
