<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@domain.com',
            'password' => '$2y$10$qjKjrzmHYfIUPxADUiEk9ezZ8G5MTjUeyHH8uVPVTtEUs9Mt/2Csi',
            'is_admin' => 1
        ]);
    }
}
