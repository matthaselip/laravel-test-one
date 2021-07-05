<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds for admin user
     *
     * @return void
     */
    public function run()
    {
        User::factory([
            'name' => 'administrator',
            'email' => 'admin@admin.com'
        ])->create();
    }
}
