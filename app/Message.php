<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = ['token', "user_type","ip_addr", "content", "isPrivate","type", "is_read", "read_at", "password", "duration"];
}
