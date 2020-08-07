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

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function setFirstNameAttribute($value)
    {
        $this->attribute['first_name'] =  ucfirst($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attribute['last_name'] =  ucfirst($value);
    }
}
