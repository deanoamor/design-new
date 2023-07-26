<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'members_id',
        'postings_id',
        'image_prove_name',
        'image_prove_url',
        'text',
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
