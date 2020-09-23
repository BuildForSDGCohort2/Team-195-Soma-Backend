<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
    protected $fillable=['module','options','question','reponse','choice'];
    protected $table="test";
    
    public function course(){

        return $this->belongsTo('App\Course');
    }
}
