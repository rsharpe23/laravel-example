<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Attachment;
use App\Extra\MediaData;

class AttachmentController extends ApiController
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
        $attachments = Attachment::all();

        return $this->sendData($attachments->map(function ($attachment) {
            return new MediaData($attachment);
        }));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('attachment')) {
            return $this->sendError('Attachment file not found');
        }

        $file = $request->file('attachment');

        if (!$file->isValid()) {
            return $this->sendError('Attachment file is invalid');
        }

        $attachment = new Attachment();
        $attachment->uuid = $file->store('public');
        $attachment->src = asset(Storage::url($attachment->uuid));
        $attachment->name = $file->getClientOriginalName();
        $attachment->save();

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
        $attachment = Attachment::findOrFail($id);
        return $this->sendData(new MediaData($attachment));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attachment = Attachment::findOrFail($id);

        if (!Storage::delete($attachment->uuid)) {
            return $this->sendError('Can not delete attachment file from storage');
        }

        $attachment->delete();
        return $this->sendSuccess();
    }
}
