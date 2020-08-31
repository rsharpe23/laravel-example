<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkRequest;
use App\Work;
use App\Link;

class WorkController extends ApiController
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
        $portfolio = Work::with('type', 'attachment', 'link')->get();
        return $this->sendData($portfolio);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkRequest $request)
    {
        $input = $request->except('link');
        $linkInput = $request->input('link');

        if (!is_array($linkInput)) {
            $linkInput = []; 
        }

        $work = Work::create($input);
        $work->link_id = Link::create($linkInput)->id;
        $work->save();

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
        $work = Work::with('type', 'attachment', 'link')
            ->findOrFail($id);
            
        return $this->sendData($work);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WorkRequest $request, $id)
    {
        $input = $request->except('link');
        $linkInput = $request->input('link');

        $work = Work::findOrFail($id);
        $work->fill($input)->save();

        if (is_array($linkInput) && isset($work->link)) {
            $work->link->fill($linkInput)->save();
        }

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
        Work::findOrFail($id)->delete();
        return $this->sendSuccess();
    }
}
