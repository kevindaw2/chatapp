<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    public function group() {
        return $this->hasOne('App\Models\ChatGroup', 'id', 'id_chat_group');
    }

    public function user() {
        return $this->hasOne('App\Models\User', 'id', 'id_user');
    }
}
