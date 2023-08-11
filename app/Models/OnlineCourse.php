<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'link',
        'price'
    ];

    public function participants (){
        return $this->hasMany(OCParticipant::class);
    }
}
