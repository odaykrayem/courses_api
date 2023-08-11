<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Models\Course;

class CParticipantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user'=>new UserResource(User::find($this->user_id)),
            'course' =>new CourseResource(Course::find($this->course_id)),
            'expired' => $this->expired??false,
            'expired_at' => $this->expired_at,
            'created_at' => $this->created_at,
        ];
    }
}
