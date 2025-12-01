<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Request::create([
            'name' => 'Kamal Perera',
            'phone' => '0771234567',
            'address' => 'No 10, Galle Road, Colombo',
            'category' => 'Food',
            'remarks' => 'Need rice, dhal, and water packets for 5 people.',
            'lat' => 6.927079,
            'lng' => 79.861244,
            'status' => 'pending',
        ]);

        \App\Models\Request::create([
            'name' => 'Siva Kumar',
            'phone' => '0719876543',
            'address' => 'Jaffna Town',
            'category' => 'Medicine',
            'remarks' => 'Insulin needed urgently.',
            'lat' => 9.661488,
            'lng' => 80.025545,
            'status' => 'pending',
        ]);
        
        \App\Models\Request::create([
            'name' => 'Nimali Silva',
            'phone' => '0755555555',
            'address' => 'Kandy Road, Kelaniya',
            'category' => 'Water',
            'remarks' => 'Drinking water bottles required.',
            'lat' => 6.9586,
            'lng' => 79.9149,
            'status' => 'accepted',
            'donor_name' => 'Red Cross',
        ]);
    }
}
