<?php

namespace App\Http\Controllers;

use App\Http\Resources\StateCollection;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return new StateCollection(State::where('short_name', '!=', 'nostate')->get());
    }
}
