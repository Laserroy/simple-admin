<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = collect(Client::all()->modelKeys());

        Company::factory()
            ->count(10000)
            ->create()
            ->each(fn($company) => $company->clients()->attach($clients->random(rand(1, 5))));
    }
}
