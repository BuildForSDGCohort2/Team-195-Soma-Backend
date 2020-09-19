<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $fillable=['name','description'];
    protected $table="course";

    public function categories()
    {
        return $this->hasManyThrough("App\Category","App\CourseCatLang");
    }

    public function languages()
    {
        return $this->hasManyThrough("App\Language","App\CourseCatLang");
    }

    public function lessons()
    {
        return $this->hasMany("App\Lesson");
    }
}
