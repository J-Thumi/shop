<?php

namespace Database\Seeders;

use App\Models\PickupLocation;
use Illuminate\Database\Seeder;

class PickupLocationSeeder extends Seeder
{
    public function run(): void
    {
        // Add your real pickup locations here.
        // Example structure:
        //
        PickupLocation::updateOrCreate(
            ['name' => 'Your collection point'],
            [
                'address' => 'Your actual address',
                'description' => 'Collection instructions',
                'phone' => 'Your contact number',
                'opening_hours' => 'Monday - Saturday, 8 AM - 5 PM',
                'is_active' => true,
            ]
        );
    }
}
