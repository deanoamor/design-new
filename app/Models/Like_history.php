<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like_history extends Model
{
    use HasFactory;

    protected $fillable = [
        'members_id',
        'postings_id',
    ];

    public function Member()
    {
        return $this->belongsTo(Member::class, 'members_id', 'id');
    }

    public function Posting()
    {
        return $this->belongsTo(Posting::class, 'postings_id', 'id');
    }
}
