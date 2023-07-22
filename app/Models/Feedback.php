<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'members_id',
        'postings_id',
        'text',
    ];

    public function Posting()
    {
        return $this->belongsTo(Posting::class, 'postings_id', 'id');
    }

    public function Member()
    {
        return $this->belongsTo(Member::class, 'members_id', 'id');
    }
}
