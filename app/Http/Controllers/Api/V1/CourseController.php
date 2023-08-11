<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\CParticipant;
use App\Filters\V1\CoursesFilter;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\V1\CourseCollection;
use App\Http\Resources\V1\CourseResource;
use Illuminate\Http\Request;
use Carbon\Carbon;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        CParticipant::where('expired_at' , '<' , Carbon::now())->update(['expired'=> true]);

        $filter = new CoursesFilter();
        $filterItems = $filter->transform($request);

        $includeVideos = $request->query('includeVideos');
        $includeParticipants = $request->query('includeParticipants');

        $courses = Course::where($filterItems);//if there are no filterItems where clause will be ignored
        if($includeVideos){
            $courses = $courses->with('videos');
        }
        if($includeParticipants){
            $courses = $courses->with('participants');
        }

        return new CourseCollection($courses->get());
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
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        return new CourseResource(Course::create($request->all()));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return new CourseResource($course);
    }

    public function getCourseVideos(Request $request){
        $includeVideos = $request->query('includeVideos');
        $courses = Course::where('id', $request->course_id);
        if($includeVideos){
            $courses = $courses->with('videos');
        }
        return new CourseCollection($courses->get());
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {

        $course->delete();
        return response()->json([
            'msg' => 'success',]);
    }
    public function delete($id)
    {
    $course = Course::where('id',$id)->count();
    if($course > 0){
        $courseObj = Course::where('id',$id);
       $courseObj->delete();

       return response()->json([
        'msg' => 'success',]);
    }else
        return response()->json([
            'msg' => 'error',]);

    }
}
