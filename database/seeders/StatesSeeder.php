<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Alaska short_name is incorrect
        $data = [
            [ '[Nation Wide]', 'nostate', 226],
            [ 'Alabama', 'AL', 226],
            [ 'Alaska', 'AK', 226],
            [ 'American Samoa', 'AS', 226],
            [ 'Arizona', 'AZ', 226],
            [ 'Arkansas', 'AR', 226],
            [ 'California', 'CA', 226],
            [ 'Colorado', 'CO', 226],
            [ 'Connecticut', 'CT', 226],
            [ 'Delaware', 'DE', 226],
            [ 'District of Columbia', 'DC', 226],
            [ 'Florida', 'FL', 226],
            [ 'Georgia', 'GA', 226],
            [ 'Guam', 'GU', 226],
            [ 'Hawaii', 'HI', 226],
            [ 'Idaho', 'ID', 226],
            [ 'Illinois', 'IL', 226],
            [ 'Indiana', 'IN', 226],
            [ 'Iowa', 'IA', 226],
            [ 'Kansas', 'KS', 226],
            [ 'Kentucky', 'KY', 226],
            [ 'Louisiana', 'LA', 226],
            [ 'Maine', 'ME', 226],
            [ 'Marshall Islands', 'MH', 226],
            [ 'Maryland', 'MD', 226],
            [ 'Massachusetts', 'MA', 226],
            [ 'Michigan', 'MI', 226],
            [ 'Minnesota', 'MN', 226],
            [ 'Mississippi', 'MS', 226],
            [ 'Missouri', 'MO', 226],
            [ 'Montana', 'MT', 226],
            [ 'Nebraska', 'NE', 226],
            [ 'Nevada', 'NV', 226],
            [ 'New Hampshire', 'NH', 226],
            [ 'New Jersey', 'NJ', 226],
            [ 'New Mexico', 'NM', 226],
            [ 'New York', 'NY', 226],
            [ 'North Carolina', 'NC', 226],
            [ 'North Dakota', 'ND', 226],
            [ 'Northern Mariana Islands', 'MP', 226],
            [ 'Ohio', 'OH', 226],
            [ 'Oklahoma', 'OK', 226],
            [ 'Oregon', 'OR', 226],
            [ 'Palau', 'PW', 226],
            [ 'Pennsylvania', 'PA', 226],
            [ 'Puerto Rico', 'PR', 226],
            [ 'Rhode Island', 'RI', 226],
            [ 'South Carolina', 'SC', 226],
            [ 'South Dakota', 'SD', 226],
            [ 'Tennessee', 'TN', 226],
            [ 'Texas', 'TX', 226],
            [ 'Utah', 'UT', 226],
            [ 'Vermont', 'VT', 226],
            [ 'Virgin Islands', 'VI', 226],
            [ 'Virginia', 'VA', 226],
            [ 'Washington', 'WA', 226],
            [ 'West Virginia', 'WV', 226],
            [ 'Wisconsin', 'WI', 226],
            [ 'Wyoming', 'WY', 226],
            [ '[Nation Wide]', 'nostate', 38],
            [ 'Alberta', 'AB', 38],
            [ 'British Columbia', 'BC', 38],
            [ 'Manitoba', 'MB', 38],
            [ 'New Brunswick', 'NB', 38],
            [ 'Newfoundland and Labrador', 'NL', 38],
            [ 'Northwest Territories', 'NT', 38],
            [ 'Nova Scotia', 'NS', 38],
            [ 'Nunavut', 'NU', 38],
            [ 'Ontario', 'ON', 38],
            [ 'Prince Edward Island', 'PE', 38],
            [ 'Quebec', 'QC', 38],
            [ 'Saskatchewan', 'SK', 38],
            [ 'Yukon Territory', 'YT', 38],
            [ 'Andaman and Nicobar Islands', 'AN', 98],
            [ 'Andhra Pradesh', 'AP', 98],
            [ 'Arunachal Pradesh', 'AR', 98],
            [ 'Assam', 'AS', 98],
            [ 'Bihar', 'BR', 98],
            [ 'Chandigarh', 'CH', 98],
            [ 'Chhattisgarh', 'CT', 98],
            [ 'Dadra and Nagar Haveli', 'DN', 98],
            [ 'Daman and Diu', 'DD', 98],
            [ 'Delhi', 'DL', 98],
            [ 'Goa', 'GA', 98],
            [ 'Gujarat', 'GJ', 98],
            [ 'Haryana', 'HR', 98],
            [ 'Himachal Pradesh', 'HP', 98],
            [ 'Jammu and Kashmir', 'JK', 98],
            [ 'Jharkhand', 'JH', 98],
            [ 'Karnataka', 'KA', 98],
            [ 'Kerala', 'KL', 98],
            [ 'Lakshadweep', 'LD', 98],
            [ 'Madhya Pradesh', 'MP', 98],
            [ 'Maharashtra', 'MH', 98],
            [ 'Manipur', 'MN', 98],
            [ 'Meghalaya', 'ML', 98],
            [ 'Mizoram', 'MZ', 98],
            [ 'Nagaland', 'NL', 98],
            [ 'Odisha', 'OR', 98],
            [ 'Puducherry', 'PY', 98],
            [ 'Punjab', 'PB', 98],
            [ 'Rajasthan', 'RJ', 98],
            [ 'Sikkim', 'SK', 98],
            [ 'Tamil Nadu', 'TN', 98],
            [ 'Telangana', 'TG', 98],
            [ 'Tripura', 'TR', 98],
            [ 'Uttar Pradesh', 'UP', 98],
            [ 'Uttarakhand', 'UT', 98],
            [ 'West Bengal', 'WB', 98]
        ];

        foreach($data as $state)
        {
            $shortName = $state[1] === 'nostate' ? 'US' : $state[1];
            $country = Country::where('states_covered', 'LIKE', $shortName)->first();
            State::create([
                'name' => $state[0],
                'short_name' => $state[1],
                'country_id' => $country->country_id
            ]);
        }
    }
}
