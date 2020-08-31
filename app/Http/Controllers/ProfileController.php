<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Profile;

class ProfileController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProfileRequest $request)
    {
        $profile = Profile::with('attachment')->firstOrFail();
        return $this->sendData($profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request)
    {
        $input = $request->all();
        Profile::firstOrFail()->fill($input)->save();
        return $this->sendSuccess();
    }
}
