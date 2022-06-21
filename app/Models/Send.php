<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Send extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    public function phonebook()
    {
        return $this->belongsTo(Phonebook::class);
    }
}
