<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'email', 'phone',
        'subject', 'message', 'status', 'reply', 'replied_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'replied_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
