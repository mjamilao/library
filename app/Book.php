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
    //this make sure that the $user is a type of User to lockdown
    public function checkout(User $user){
        /*Reservation::create([

        ]);*/
        // or make a relationship

        $this->reservations()->create([
           'user_id' => $user->id,
            'checked_out_at' => now(),
        ]);
    }

    public function checkin(User $user)
    {
        //null does not match expected type object

        //get the reservation
        $reservation = $this->reservations()->where('user_id', $user->id)
            ->whereNotNull('checked_out_at')
            ->whereNull('checked_in_at')
            ->first();

        //dd($reservation) == null;
        if(is_null($reservation)){
            throw new \Exception();
        }

        //put a time in the check_in_at if na uli na niya
        $reservation->update([
           'checked_in_at' => now(),
        ]);
    }

    public function reservations()
    {
        // a book has many reservations
        // a reservation belongs to a book and a user

        return $this->hasMany(Reservation::class);
    }
}
