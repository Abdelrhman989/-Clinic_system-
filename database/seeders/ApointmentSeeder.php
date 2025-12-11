<?php

namespace Database\Seeders;

use App\Models\Apointment;
use Illuminate\Database\Seeder;

class ApointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Apointment::factory()->count(10)->create();
    }
}
