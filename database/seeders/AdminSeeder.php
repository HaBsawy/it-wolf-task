<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'              => 'eslam94',
            'email'             => 'eslam.habsa94@gmail.com',
            'password'          => bcrypt('123123'),
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);
    }
}
