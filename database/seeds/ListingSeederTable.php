<?php

use App\Listing;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class ListingSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listings = [
            [
                'name'           => 'Starbuck Mid Valley',
                'latitude'       => '3.127397',
                'longitude'      => '101.678813',
                'user_id'        => 1,
                'created_at'     => Date::now(),
                'updated_at'     => Date::now()
            ],
            [
                'name'           => 'Burger King',
                'latitude'       => '3.126625',
                'longitude'      => '101.670659',
                'user_id'        => 1,
                'created_at'     => Date::now(),
                'updated_at'     => Date::now()
            ],
            [
                'name'           => 'Klang',
                'latitude'       => '2.740163',
                'longitude'      => '101.467057',
                'user_id'        => 1,
                'created_at'     => Date::now(),
                'updated_at'     => Date::now()
            ],
            [
                'name'           => 'Ayer Keroh',
                'latitude'       => '2.266400',
                'longitude'      => '102.294229',
                'user_id'        => 2,
                'created_at'     => Date::now(),
                'updated_at'     => Date::now()
            ],
            [
                'name'           => 'Lubok China',
                'latitude'       => '2.455851',
                'longitude'      => '102.073221',
                'user_id'        => 2,
                'created_at'     => Date::now(),
                'updated_at'     => Date::now()
            ],
        ];

        Listing::insert($listings);
    }
}
