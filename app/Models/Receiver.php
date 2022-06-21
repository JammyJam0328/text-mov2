<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    public function receivers()
    {
        return $this->hasMany(Receiver::class);
    }
}
