<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LinkTarget;

class LinkTargetController extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return $this->sendData(LinkTarget::all());
    }
}
