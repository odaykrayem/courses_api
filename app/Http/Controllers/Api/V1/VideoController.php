<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\Video;
use App\Models\CParticipant;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Http\Resources\V1\VideoCollection;
use App\Http\Resources\V1\VideoResource;
use Carbon\Carbon;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        CParticipant::where('expired_at' , '<' , Carbon::now())->update(['expired'=> true]);

        return new VideoCollection(Video::all());
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
     * @param  \App\Http\Requests\StoreVideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideoRequest $request)
    {

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'video' => 'required|file|mimetypes:video/mp4',
            'description' =>'required',
            'course_id' => 'required'
      ]);
      $video = new Video();
      $video->title = $request->title;
      $video->description = $request->description;
      $video->course_id = $request->course_id;
      if ($request->hasFile('video'))
      {
        $path = $request->file('video')->store('videos', ['disk' =>  'my_files']);
        $video->link = $path;
      }
      $video->save();

      return new VideoResource(Video::where('id', $video->id)->first());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return new VideoResource($video);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVideoRequest  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVideoRequest $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }

    public function delete($id)
    {
    $dbObj = Video::where('id',$id)->count();
    if($dbObj > 0){
        $obj = Video::where('id',$id);
       $obj->delete();

       return response()->json([
        'msg' => 'success',]);
    }else
        return response()->json([
            'msg' => 'error',]);

    }
}
