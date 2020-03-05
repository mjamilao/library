<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    //turning off the mass assignment protection. explicit the fields your passing in to avoid injection
    protected $guarded = [];

    public function path()
    {
        return '/books/'.$this->id;

        //if you decided to have a slug /books/1-Maverick
        //return '/books/' . $this->id . '-' . Str::slug($this->title);
    }

    public function setAuthorIdAttribute($author)
    {
        $this->attributes['author_id'] = (Author::firstOrCreate([
            'name' => $author,
        ]))->id;
    }
}
