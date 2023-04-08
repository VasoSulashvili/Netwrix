<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartnerRequest;
use App\Http\Resources\PartnerCollection;
use App\Models\Partner;

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
        if($request->input('country') || $request->input('state') == 'nostate')
        {
            $country = $request->input('state') == 'nostate' ? 'US' : $request->input('country');
            $partners->where('countries_covered', 'LIKE', '%'.$country.'%');
        }
        if($request->input('state') && $request->input('state') !== 'nostate')
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
