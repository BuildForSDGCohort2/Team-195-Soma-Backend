<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseCatLang extends Model
{
    //
    protected $fillable=['course_id','language_id',"category_id"];
    protected $table="course_cat_lang";
}
