<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function adresses()
    {
        return $this->hasMany(Address::class);
    }
}
