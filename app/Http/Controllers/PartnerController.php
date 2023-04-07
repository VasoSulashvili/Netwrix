<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorPageException;
use App\Http\Requests\PartnerRequest;
use App\Http\Resources\PartnerCollection;
use App\Models\Partner;
use Exception;

class PartnerController extends Controller
{
    
    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(PartnerRequest $request)
    {
        $partners = Partner::query();

        if($request->input('type'))
        {
            $partners->where('status', '=', $request->input('type'));
        }
        if($request->input('country'))
        {
            $partners->where('countries_covered', 'LIKE', '%'.$request->input('country').'%');
        }
        if($request->input('state'))
        {
            $partners->where('states_covered', 'LIKE', '%'.$request->input('state').'%');
        }
        if($request->input('search'))
        {
            $partners->where('address', 'LIKE', '%'.$request->input('search').'%')
                ->orWhere('company', 'LIKE', '%'.$request->input('search').'%');
        }
        return new PartnerCollection($partners->get());

        
    }
}
