<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //turning off the mass assignment protection. explicit the fields your passing in to avoid injection
    protected $guarded = [];
}
