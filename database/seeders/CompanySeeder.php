<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * create companies with their employees
     *
     * @return void
     */
    public function run()
    {
        Company::factory()->count(20)
            ->hasEmployees(10)
            ->create();
    }
}
