<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecretAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'account_name',
        'account_email',
        'password',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
