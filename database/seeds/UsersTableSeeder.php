<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'role_type'      => 'a',
                'password'       => '$2y$10$Vr/mYRcIkhXVoBryt538Au/B/X64uDT91KtDJVrbIQc5IRp2IdPVS',
                'remember_token' => null,
                'created_at'     => Date::now(),
                'updated_at'     => Date::now()
            ],
            [
                'id'             => 2,
                'name'           => 'User',
                'email'          => 'user@user.com',
                'role_type'      => 'u',
                'password'       => '$2y$10$Vr/mYRcIkhXVoBryt538Au/B/X64uDT91KtDJVrbIQc5IRp2IdPVS',
                'remember_token' => null,
                'created_at'     => Date::now(),
                'updated_at'     => Date::now()
            ]
        ];

        User::insert($users);
    }
}
