<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    use HasFactory;

    protected $fillable = [
        'members_id',
        'image_name',
        'file_name',
        'image_url',
        'file_url',
        'title',
        'description',
        'price',
        'status',
        'type',
        'is_free',
        'download',
        'like',
        'feedback',
        'income'
    ];

    //format
    public function getFormattedPriceAttribute()
    {
        return number_format($this->attributes['price']);
    }

    public function getFormattedIncomeAttribute()
    {
        return number_format($this->attributes['income']);
    }

    //relation
    public function Member()
    {
        return $this->belongsTo(Member::class, 'members_id', 'id');
    }

    public function Feedbacks()
    {
        return $this->hasMany(Feedback::class, 'postings_id', 'id');
    }

    public function Like_histories()
    {
        return $this->hasMany(Like_history::class, 'postings_id', 'id');
    }

    public function Carts()
    {
        return $this->hasMany(Cart::class, 'postings_id', 'id');
    }

    public function Reports()
    {
        return $this->hasMany(Report::class, 'postings_id', 'id');
    }
}
