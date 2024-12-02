<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transportation; // Ensure the correct model namespace is used

class TransportationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add multiple transportation records to seed the database
        Transportation::create([
            'id' => 'AB1234',
            'type' => 'Bus',
            'capacity' => 50,
            'route' => 'City A - City B',
            'status' => 'Active',
        ]);

        Transportation::create([
            'id' => 'CD5678',
            'type' => 'Van',
            'capacity' => 15,
            'route' => 'City C - City D',
            'status' => 'Inactive',
        ]);

        Transportation::create([
            'id' => 'EF9012',
            'type' => 'Truck',
            'capacity' => 10,
            'route' => 'City E - City F',
            'status' => 'Active',
        ]);
    }
}
