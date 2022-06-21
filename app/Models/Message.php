<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function attachments()
    {
        return $this->hasMany(Attachement::class);
    }

    public function sends()
    {
        return $this->hasMany(Send::class);
    }
    public function receivers()
    {
        return $this->hasMany(Receiver::class);
    }
}
