<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [

            [
                'name' => 'ceo',
                'display_name' => 'CEO',
                'description' => 'Full system access',
                'status' => 'Active',
            ],

            [
                'name' => 'branch_manager',
                'display_name' => 'Branch Manager',
                'description' => 'Manage branch operations',
                'status' => 'Active',
            ],

            [
                'name' => 'sales_manager',
                'display_name' => 'Sales Manager',
                'description' => 'Approve sales and assign recovery officers',
                'status' => 'Active',
            ],

            [
                'name' => 'sales_officer',
                'display_name' => 'Sales Officer',
                'description' => 'Handle sale corrections, returns and exchanges',
                'status' => 'Active',
            ],

            [
                'name' => 'salesman',
                'display_name' => 'Salesman',
                'description' => 'Create customer sales',
                'status' => 'Active',
            ],

            [
                'name' => 'recovery_officer',
                'display_name' => 'Recovery Officer',
                'description' => 'Collect customer recoveries',
                'status' => 'Active',
            ],

            [
                'name' => 'accountant',
                'display_name' => 'Accountant',
                'description' => 'Manage accounts and finance',
                'status' => 'Active',
            ],

        ];

        foreach ($roles as $role) {

            Role::updateOrCreate(
                ['name' => $role['name']],
                $role
            );

        }
    }
}