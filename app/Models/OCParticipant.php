<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class OCParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'online_course_id',
        'expired',
        'expired_at'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(OnlineCourse::class, 'o_course_id');
    }

}
