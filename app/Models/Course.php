<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price'
    ];


    public function videos (){
        return $this->hasMany(Video::class);
    }

    public function participants (){
        return $this->hasMany(CParticipant::class);
    }
}
