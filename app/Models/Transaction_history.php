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
        'design_members_id',
        'real_postings_id',
        'status',
        'amount',
        'total',
        'admin_fee',
    ];

    //format
    public function getFormattedTotalAttribute()
    {
        return number_format($this->attributes['total']);
    }

    public function getFormattedAdminFeeAttribute()
    {
        return number_format($this->attributes['admin_fee']);
    }

    //relation
    public function Member()
    {
        return $this->belongsTo(Member::class, 'members_id', 'id');
    }

    public function Copy_posting()
    {
        return $this->belongsTo(Copy_posting::class, 'copy_postings_id', 'id');
    }
}
