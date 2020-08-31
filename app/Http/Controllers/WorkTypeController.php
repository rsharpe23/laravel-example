<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkTypeRequest;
use App\WorkType;

class WorkTypeController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->except([
            'index', 'show',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendData(WorkType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkTypeRequest $request)
    {
        WorkType::create($request->all());
        return $this->sendSuccess(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->sendData(WorkType::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WorkTypeRequest $request, $id)
    {
        WorkType::findOrFail($id)
            ->fill($request->all())
            ->save();
            
        return $this->sendSuccess();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WorkType::findOrFail($id)->delete();
        return $this->sendSuccess();
    }
}
