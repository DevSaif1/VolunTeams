<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminRolesUpgradeSeeder extends Seeder
{
    /**
     * Run the database seeds safely on both Local and Production (Alwaysdata).
     */
    public function run(): void
    {
        // 1. Ensure all roles exist
        $roles = ['Super Admin', 'Admin', 'Demo Admin', 'Team Manager', 'Member'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);
        }

        // 2. Upgrade primary admin account to Super Admin
        $superAdmin = User::where('email', 'admin@volunteams.com')->first();
        if ($superAdmin) {
            $superAdmin->syncRoles(['Super Admin']);
        }

        // 3. Create 4 Dedicated Demo Accounts for University & Faculty Review
        $demoAccounts = [
            [
                'name' => 'Demo Admin (مراجعة الإدارة)',
                'email' => 'demo.admin@volunteams.com',
                'password' => 'DemoAdmin@2026',
                'role' => 'Demo Admin',
                'is_demo_member' => true,
            ],
            [
                'name' => 'University Admin (عمادة شؤون الطلبة)',
                'email' => 'dean.admin@volunteams.com',
                'password' => 'DeanAdmin@2026',
                'role' => 'Admin',
                'is_demo_member' => true,
            ],
            [
                'name' => 'Demo Team Manager (تجربة مدير فريق)',
                'email' => 'demo.manager@volunteams.com',
                'password' => 'DemoManager@2026',
                'role' => 'Team Manager',
                'is_demo_member' => true,
            ],
            [
                'name' => 'Demo Volunteer (تجربة متطوع)',
                'email' => 'demo.member@volunteams.com',
                'password' => 'DemoMember@2026',
                'role' => 'Member',
                'is_demo_member' => true,
            ],
        ];

        foreach ($demoAccounts as $account) {
            $user = User::updateOrCreate(
                ['email' => $account['email']],
                [
                    'name' => $account['name'],
                    'password' => Hash::make($account['password']),
                    'email_verified_at' => now(),
                    'is_demo_member' => $account['is_demo_member'],
                ]
            );

            $user->syncRoles([$account['role']]);
        }
    }
}