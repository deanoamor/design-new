<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'username',
        'image_name',
        'image_url',
        'no_hp',
        'wallet',
    ];

    //format
    public function getFormattedWalletAttribute()
    {
        return number_format($this->attributes['wallet']);
    }

    //relation
    public function User()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
