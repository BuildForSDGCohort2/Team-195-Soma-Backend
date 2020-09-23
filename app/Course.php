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
        return $this->hasManyThrough("App\Category","App\CourseCatLang","course_id","id");
    }

    public function languages()
    {
        return $this->hasManyThrough("App\Language","App\CourseCatLang","course_id","id");
    }

    public function lessons()
    {
        return $this->hasMany("App\Lesson");
    }

    public function grades()
    {
        return $this->hasMany("App\Grade");
    }
}
