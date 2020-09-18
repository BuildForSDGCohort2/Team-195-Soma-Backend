<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $fillable=['name','description'];

    public function category()
    {
        return $this->hasMany("App\Category");
    }

    public function lessons()
    {
        return $this->hasMany("App\Lesson");
    }
}
