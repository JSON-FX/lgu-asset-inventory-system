<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AllDataSeeder extends Seeder
{
    public function run()
    {
        // Insert dummy data into categories table
        DB::table('categories')->insert([
            ['category_name' => 'Electronics', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Furnitures', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Vehicles', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Stationery', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insert dummy data into offices table
        DB::table('offices')->insert([
            ['office_name' => 'Head Office', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'Branch Office 1', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'Branch Office 2', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insert dummy data into statuses table
        DB::table('statuses')->insert([
            ['status_name' => 'Serviceable', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'Maintenance', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'Unserviceable', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insert dummy data into employees table
        DB::table('employees')->insert([
            ['employee_name' => 'John Lopez', 'created_at' => now(), 'updated_at' => now()],
            ['employee_name' => 'Jane Smith', 'created_at' => now(), 'updated_at' => now()],
            ['employee_name' => 'Mark Johnson', 'created_at' => now(), 'updated_at' => now()],
            ['employee_name' => 'Emily Davis', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insert dummy data into properties table
        DB::table('properties')->insert([
            ['property_number' => 'PN-001', 'description' => 'Dell Laptop', 'serial_number' => 'SN-12345', 'office_id' => 1, 'category_id' => 1, 'status_id' => 1, 'employee_id' => 1, 'date_purchase' => '2024-01-01', 'acquisition_cost' => 50000.00, 'inventory_remarks' => 'For IT department use', 'created_at' => now(), 'updated_at' => now()],
            ['property_number' => 'PN-002', 'description' => 'Office Chair', 'serial_number' => null, 'office_id' => 2, 'category_id' => 2, 'status_id' => 1, 'employee_id' => 2, 'date_purchase' => '2023-12-01', 'acquisition_cost' => 3000.00, 'inventory_remarks' => 'Ergonomic chair', 'created_at' => now(), 'updated_at' => now()],
            ['property_number' => 'PN-003', 'description' => 'Toyota Corolla', 'serial_number' => 'SN-56789', 'office_id' => 3, 'category_id' => 3, 'status_id' => 2, 'employee_id' => 3, 'date_purchase' => '2022-06-15', 'acquisition_cost' => 800000.00, 'inventory_remarks' => 'Company car for sales', 'created_at' => now(), 'updated_at' => now()],
            // Add more properties as needed
        ]);

        // Insert dummy data into users table (admin user)
        DB::table('users')->insert([
            'name' => 'PSMD',
            'email' => 'admin@admin.com',
            'password' => Hash::make('psmd2024'), // Password hash
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
