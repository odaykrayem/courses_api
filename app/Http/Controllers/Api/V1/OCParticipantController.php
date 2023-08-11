<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\OCParticipant;
use App\Http\Requests\StoreOCParticipantRequest;
use App\Http\Requests\UpdateOCParticipantRequest;

class OCParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreOCParticipantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOCParticipantRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OCParticipant  $oCParticipant
     * @return \Illuminate\Http\Response
     */
    public function show(OCParticipant $oCParticipant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OCParticipant  $oCParticipant
     * @return \Illuminate\Http\Response
     */
    public function edit(OCParticipant $oCParticipant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOCParticipantRequest  $request
     * @param  \App\Models\OCParticipant  $oCParticipant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOCParticipantRequest $request, OCParticipant $oCParticipant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OCParticipant  $oCParticipant
     * @return \Illuminate\Http\Response
     */
    public function destroy(OCParticipant $oCParticipant)
    {
        //
    }

    public function delete($id)
    {
    $dbObj = OCParticipant::where('id',$id)->count();
    if($dbObj > 0){
        $obj = OCParticipant::where('id',$id);
       $obj->delete();

       return response()->json([
        'msg' => 'success',]);
    }else
        return response()->json([
            'msg' => 'error',]);

    }
}
