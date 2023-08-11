<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CoursesFilter extends ApiFilter{
   protected $safeParams =[
      'created_at' => ['lt','eq','gt'],
      'price' => ['lt','eq','gt'], //less than , equal , greater than

   ];

   //transfrom into db column
   protected $columnMap = [
       'created_at' => 'created_at',
       'price' => 'price'
   ];
}
