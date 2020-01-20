<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = ['title'];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
