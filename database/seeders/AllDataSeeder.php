<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
class AllDataSeeder extends Seeder
{
    public function run()
    {
        DB::table('accounts')->insert([
            ['id' => 1, 'account_name' => 'Account 1'],
            ['id' => 2, 'account_name' => 'Account 2'],
            ['id' => 3, 'account_name' => 'Account 3'],
        ]);
        
    
        // Insert dummy data into categories table
        DB::table('categories')->insert([
            ['category_name' => 'Machinery & Equipments', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Office Equipments', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'ICT', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Agricultural & Forestry', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Communication Equipment', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Construction & Heavy Equipment', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Disaster Response and Rescue Equipment', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Military, Police & Security Equipment', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Medical Equipment', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Sports Equipment', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Technology & Scientific', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Motor Vehicles', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Furniture & Fixture', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Other PPE', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Computer Software', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Laboratory', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Other Transportation Equipment', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insert dummy data into offices table
        DB::table('offices')->insert([
            ['office_name' => 'MMO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MMO-PS', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MMO-BPLD', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MMO-MIS', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MMO-PESO/LIVELIHOOOD', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MMO-TESDA', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MMO-PSMD', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MMO-PIO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MMO-TOURISM', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MMO-PURCHASING', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MMO-BARANGAY AFFAIRS', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MMO-ECCCO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'FEDERATION HALL', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'SBO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MSWDO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MASSO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MACCO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MTO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MBO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'HRMO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MCRO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MPDO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'BAC', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => '4PS', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MHO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'QHCI', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'BFP', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'DILG', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'BIR', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'COA', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'COMELEC', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'PNP', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'PHILPOST', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'KALAHI', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'LTO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'DAR', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MPSO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MDRRMO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'LOCAL ENFORCEMENT', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'TMD', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'CSU', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MEMO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MAGRO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MENRO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MRF', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MEO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'GSD', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'MTC', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'PAO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'BUKSU', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'LSB', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'School District', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insert dummy data into statuses table
        DB::table('statuses')->insert([
            ['status_name' => 'Serviceable', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'Maintenance', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'Unserviceable', 'created_at' => now(), 'updated_at' => now()],
        ]);

       
        // DB::table('employees')->insert([
        //     ['employee_name' => 'John Lopez', 'created_at' => now(), 'updated_at' => now()],
        //     ['employee_name' => 'Jane Smith', 'created_at' => now(), 'updated_at' => now()],
        //     ['employee_name' => 'Mark Johnson', 'created_at' => now(), 'updated_at' => now()],
        //     ['employee_name' => 'Emily Davis', 'created_at' => now(), 'updated_at' => now()],
        // ]);

        // Insert dummy data into properties table
        // DB::table('properties')->insert([
        //     ['property_number' => 'PN-001', 'description' => 'Dell Laptop', 'serial_number' => 'SN-12345', 'office_id' => 1, 'category_id' => 1, 'status_id' => 1, 'employee_id' => 1, 'date_purchase' => '2024-01-01', 'acquisition_cost' => 50000.00, 'inventory_remarks' => 'For IT department use', 'created_at' => now(), 'updated_at' => now()],
        //     ['property_number' => 'PN-002', 'description' => 'Office Chair', 'serial_number' => null, 'office_id' => 2, 'category_id' => 2, 'status_id' => 1, 'employee_id' => 2, 'date_purchase' => '2023-12-01', 'acquisition_cost' => 3000.00, 'inventory_remarks' => 'Ergonomic chair', 'created_at' => now(), 'updated_at' => now()],
        //     ['property_number' => 'PN-003', 'description' => 'Toyota Corolla', 'serial_number' => 'SN-56789', 'office_id' => 3, 'category_id' => 3, 'status_id' => 2, 'employee_id' => 3, 'date_purchase' => '2022-06-15', 'acquisition_cost' => 800000.00, 'inventory_remarks' => 'Company car for sales', 'created_at' => now(), 'updated_at' => now()],
        //     // Add more properties as needed
        // ]);

        // Insert dummy data into users table (admin user)
        DB::table('users')->insert([
            'name' => 'PSMD',
            'email' => 'admin@admin.com',
            'password' => Hash::make('psmd2024'), // Password hash
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // $faker = Faker::create();

        // // Static IDs for office, category, status, account, and employee
        // $officeIds = [1, 2, 3];
        // $categoryIds = [1, 2, 3];
        // $statusIds = [1, 2, 3];
        // $accountIds = [1, 2, 3];
        // $employeeIds = [1, 2, 3]; // Employee 2 can have the same set

        // for ($i = 0; $i < 30; $i++) {
        //     DB::table('properties')->insert([
        //         'property_number' => 'P-' . $faker->unique()->numberBetween(1000, 9999),
        //         'description' => $faker->sentence(),
        //         'serial_number' => $faker->unique()->word(),
        //         'engine_number' => $faker->unique()->word(),
        //         'chasis_number' => $faker->unique()->word(),
        //         'plate_number' => $faker->unique()->word(),
        //         'elc_number' => $faker->unique()->word(),
        //         'office_id' => $faker->randomElement($officeIds), // Using static IDs 1, 2, 3
        //         'category_id' => $faker->randomElement($categoryIds), // Using static IDs 1, 2, 3
        //         'status_id' => $faker->randomElement($statusIds), // Using static IDs 1, 2, 3
        //         'account_id' => $faker->randomElement($accountIds), // Using static IDs 1, 2, 3
        //         'employee_id' => $faker->randomElement($employeeIds), // Using static IDs 1, 2, 3
        //         'employee_id2' => $faker->randomElement($employeeIds), // Using static IDs 1, 2, 3
        //         'date_purchase' => $faker->date(),
        //         'acquisition_cost' => $faker->randomFloat(2, 1000, 100000),
        //         'qty' => $faker->randomFloat(2, 1, 10),
        //         'inventory_remarks' => $faker->text(200),
        //         'image_path' => $faker->imageUrl(),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
    
        
    }
}
