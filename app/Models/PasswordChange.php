<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordChange extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'old_password_hash', 'new_password_hash'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}