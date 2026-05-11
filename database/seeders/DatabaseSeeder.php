<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BloodInventory;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {

        // Admin user
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@blood.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Donor user
        User::create([
            'name'        => 'John Donor',
            'email'       => 'donor@blood.com',
            'password'    => Hash::make('password'),
            'role'        => 'donor',
            'blood_group' => 'O+',
            'phone'       => '9876543210',
        ]);

        // Hospital user
        User::create([
            'name'     => 'City Hospital',
            'email'    => 'hospital@blood.com',
            'password' => Hash::make('password'),
            'role'     => 'hospital',
            'phone'    => '9876543211',
        ]);

        // Blood Inventory seed
        $bloodGroups = ['A+','A-','B+','B-','AB+','AB-','O+','O-'];
        foreach ($bloodGroups as $group) {
            BloodInventory::create([
                'blood_group'     => $group,
                'units_available' => rand(10, 100),
                'units_reserved'  => rand(0, 10),
                'last_updated'    => now(),
            ]);
        }
    }
}
