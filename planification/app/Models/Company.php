<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    //belongsto section
    
    public function battalion()
    {
        return $this->belongsTo(Battalion::class);
    }
    public function sessions($week_id)
    {
        return $this->belongsToMany(Session::class,'session_companies')->where('week_id',$week_id);
    }
    public function sections()
    {
        return $this->hasMany(Section::class)->orderBy('section');
    }
    public function modules(){
        return Module::where('sector',$this->sector)->where('battalion_id',$this->battalion_id);
    }
    
}
