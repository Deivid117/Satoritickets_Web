<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat_User extends Model
{
    use HasFactory;
    protected $table = "chat_user";
    protected $fillable = [
        'id',
        'user_id',
        'chat_id',
    ];
}
