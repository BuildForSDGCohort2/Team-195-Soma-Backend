<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //
    protected $fillable=["grade"];
    protected $table="grade";

    public function user()
    {
        
        return $this->belongsTo("App\User");
    }

    public function course()
    {
        
        return $this->belongsTo("App\Course");
    }

}
