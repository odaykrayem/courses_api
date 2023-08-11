<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\OnlineCourse;
use App\Http\Requests\StoreOnlineCourseRequest;
use App\Http\Requests\UpdateOnlineCourseRequest;
use Illuminate\Http\Request;
use App\Filters\V1\OnlineCoursesFilter;
use App\Http\Resources\V1\OnlineCourseResource;
use App\Http\Resources\V1\OnlineCourseCollection;

class OnlineCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = new OnlineCoursesFilter();
        $filterItems = $filter->transform($request);

        $includeVideos = $request->query('includeVideos');
        $includeParticipants = $request->query('includeParticipants');

        $courses = OnlineCourse::where($filterItems);//if there are no filterItems where clause will be ignored
        if($includeVideos){
            $courses = $courses->with('videos');
        }
        if($includeParticipants){
            $courses = $courses->with('participants');
        }

        return new OnlineCourseCollection($courses->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOnlineCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOnlineCourseRequest $request)
    {
        return new onlineCourseResource(OnlineCourse::create($request->all()));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OnlineCourse  $onlineCourse
     * @return \Illuminate\Http\Response
     */
    public function show(OnlineCourse $onlineCourse)
    {
        return new OnlineCourseResource($onlineCourse);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OnlineCourse  $onlineCourse
     * @return \Illuminate\Http\Response
     */
    public function edit(OnlineCourse $onlineCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOnlineCourseRequest  $request
     * @param  \App\Models\OnlineCourse  $onlineCourse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOnlineCourseRequest $request, OnlineCourse $onlineCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OnlineCourse  $onlineCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(OnlineCourse $onlineCourse)
    {
        //
    }

    public function delete($id)
    {
    $course = OnlineCourse::where('id',$id)->count();
    if($course > 0){
        $courseObj = OnlineCourse::where('id',$id);
       $courseObj->delete();

       return response()->json([
        'msg' => 'success',]);
    }else
        return response()->json([
            'msg' => 'error',]);

    }
}
