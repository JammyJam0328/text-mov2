<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function phonebooks()
    {
        return $this->hasMany(Phonebook::class);
    }

    public function receivers()
    {
        return $this->hasMany(Receiver::class);
    }
}
