<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    protected $fillable=['name','country'];
    protected $table="language";

    public function courses()
    {
        return $this->hasManyThrough("App\Course","App\CourseCatLang");
    }

    
}
