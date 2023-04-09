<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorPageException;
use App\Http\Requests\PartnerRequest;
use App\Http\Resources\PartnerCollection;
use App\Models\Country;
use App\Models\Partner;
use App\Models\State;

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
            $partners->where('status', '=', str_replace('_', ' ', $request->input('type')));
        }
        if($request->input('country'))
        {
            $partners->where('countries_covered', 'LIKE', '%'.$request->input('country').'%');
        }
        if($request->input('state'))
        {
            // if state is 'nostate' select by country
            if($request->input('state') === 'nostate')
            {
                $noStateCountryIds = State::where('short_name', '=', 'nostate')->get()->pluck('country_id')->toArray();
                $countryId = Country::where('short_name', '=', $request->input('country'))->first()?->country_id;
                if(!in_array($countryId, $noStateCountryIds))
                {
                    throw new ErrorPageException('Invalid country and state pair. Choose country only, please!');
                }
                $partners->where('countries_covered', 'LIKE', '%'.$request->input('country').'%');
            }
            else
            {
                $partners->where('states_covered', 'LIKE', '%'.$request->input('state').'%');
            }
            
        }
        if($request->input('search'))
        {
            $partners->where('address', 'LIKE', '%'.$request->input('search').'%')
                ->orWhere('company', 'LIKE', '%'.$request->input('search').'%');
        }
        return new PartnerCollection($partners->get());

        
    }
}
