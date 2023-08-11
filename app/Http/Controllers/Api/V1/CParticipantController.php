<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\CParticipant;
use App\Http\Requests\StoreCParticipantRequest;
use App\Http\Requests\UpdateCParticipantRequest;
use App\Http\Resources\V1\CParticipantCollection;
use App\Http\Resources\V1\CParticipantResource;
use Carbon\Carbon;
use App\Filters\V1\CParticipantFilter;
use Illuminate\Http\Request;

class CParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        CParticipant::where('expired_at' , '<' , Carbon::now())->update(['expired'=> true]);

        $filter = new CParticipantFilter();
        $filterItems = $filter->transform($request);

        $includeVideos = $request->query('includeVideos');
        $includeParticipants = $request->query('includeParticipants');

        $participants = CParticipant::where($filterItems);//if there are no filterItems where clause will be ignored

        return new CParticipantCollection($participants->get());
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
     * @param  \App\Http\Requests\StoreCParticipantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCParticipantRequest $request)
    {
        return new CParticipantResource(CParticipant::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CParticipant  $cParticipant
     * @return \Illuminate\Http\Response
     */
    public function show(CParticipant $cParticipant)
    {
        return new CParticipantResource($cParticipant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CParticipant  $cParticipant
     * @return \Illuminate\Http\Response
     */
    public function edit(CParticipant $cParticipant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCParticipantRequest  $request
     * @param  \App\Models\CParticipant  $cParticipant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCParticipantRequest $request, CParticipant $cParticipant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CParticipant  $cParticipant
     * @return \Illuminate\Http\Response
     */
    public function destroy(CParticipant $cParticipant)
    {
        //
    }

    public function delete($id)
    {
    $dbObj = CParticipant::where('id',$id)->count();
    if($dbObj > 0){
        $obj = CParticipant::where('id',$id);
       $obj->delete();

       return response()->json([
        'msg' => 'success',]);
    }else
        return response()->json([
            'msg' => 'error',]);

    }
}
