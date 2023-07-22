<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copy_posting extends Model
{
    use HasFactory;

    protected $fillable = [
        'members_id',
        'postings_id',
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
    ];

    public function Transaction_histories()
    {
        return $this->hasMany(Transaction_history::class, 'copy_postings_id', 'id');
    }
}
