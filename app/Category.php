<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table="category";
    protected $fillable=['name','code'];

    public function courses()
    {
        return $this->hasManyThrough("App\Course","App\CourseCatLang");
    }

    
}
