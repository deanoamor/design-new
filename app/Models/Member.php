<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'username',
        'image_name',
        'image_url',
        'no_hp',
        'wallet',
        'status',
    ];

    //format
    public function getFormattedWalletAttribute()
    {
        return number_format($this->attributes['wallet']);
    }

    //relation
    public function Postings()
    {
        return $this->hasMany(Posting::class, 'postings_id', 'id');
    }

    public function Transaction_histories()
    {
        return $this->hasMany(Transaction_history::class, 'members_id', 'id');
    }

    public function Like_histories()
    {
        return $this->hasMany(Like_history::class, 'members_id', 'id');
    }

    public function Carts()
    {
        return $this->hasMany(Cart::class, 'members_id', 'id');
    }

    public function Reports()
    {
        return $this->hasMany(Report::class, 'members_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function Feedbacks()
    {
        return $this->hasMany(Feedback::class, 'feedbacks_id', 'id');
    }
}
