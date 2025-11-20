<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            [
                'name' => 'Dr. Sari Putri',
                'specialty' => 'General Practitioner',
                'photo_url' => null,
                'available' => true,
            ],
            [
                'name' => 'Dr. Budi Santoso',
                'specialty' => 'Pediatrics',
                'photo_url' => null,
                'available' => false,
            ],
            [
                'name' => 'Dr. Arif Nugroho',
                'specialty' => 'Cardiologist',
                'photo_url' => null,
                'available' => true,
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}
