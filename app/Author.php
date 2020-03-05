<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded = [];

    //tell the laravel to automatically cast them into carbon instance
    //in this case the dob
    protected $dates = ['dob'];

    //hijack the creation
    /*public function setDobAttribute($dob)
    {
        $this->attributes['dob'] = Carbon::parse('dob');
    }*/
}
