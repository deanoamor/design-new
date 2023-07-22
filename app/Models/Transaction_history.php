<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction_history extends Model
{
    use HasFactory;

    protected $fillable = [
        'members_id',
        'copy_postings_id',
        'status',
    ];

    public function Member()
    {
        return $this->belongsTo(Member::class, 'members_id', 'id');
    }
}
