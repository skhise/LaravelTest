<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Hash;
use Illuminate\Support\Str;


class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'    => 'Shekhar',
            'email'    => 'shekhar@gmail.com',
            'password'   =>  Hash::make('password'),
            'last_seen_at'=> null,
            'remember_token' =>  Str::random(10),
        ]);
    }
}
