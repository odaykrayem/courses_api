<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'title',
        'description',
        'course_id'
    ];


    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
