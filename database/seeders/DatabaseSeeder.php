<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\PurchaseRequest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Users
        $owner = User::create([
            'name' => 'Budi (Owner)',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
        ]);

        $finance = User::create([
            'name' => 'Siti (Finance Staff)',
            'email' => 'finance@example.com',
            'password' => Hash::make('password'),
            'role' => 'finance',
        ]);

        $karyawan1 = User::create([
            'name' => 'Andi (Karyawan)',
            'email' => 'andi@example.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);

        $karyawan2 = User::create([
            'name' => 'Bambang (Karyawan)',
            'email' => 'bambang@example.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);

        $karyawanDzaki = User::create([
            'name' => 'Dzaki (Karyawan)',
            'email' => 'dzaki@example.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);

        $karyawanAfifah = User::create([
            'name' => 'Afifah (Karyawan)',
            'email' => 'afifah@example.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);

        $karyawanRaka = User::create([
            'name' => 'Raka (Karyawan)',
            'email' => 'raka@example.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);

        $karyawanFikri = User::create([
            'name' => 'Fikri (Karyawan)',
            'email' => 'fikri@example.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);

        $karyawanSatria = User::create([
            'name' => 'Satria (Karyawan)',
            'email' => 'satria@example.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);

        $karyawanFajar = User::create([
            'name' => 'Fajar (Karyawan)',
            'email' => 'fajar@example.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);

        // 2. Create Categories
        $catIncome1 = Category::create(['name' => 'Penjualan Produk', 'type' => 'income']);
        $catIncome2 = Category::create(['name' => 'Pendapatan Jasa', 'type' => 'income']);
        $catIncome3 = Category::create(['name' => 'Suntikan Dana', 'type' => 'income']);

        $catExpense1 = Category::create(['name' => 'Biaya Operasional (Listrik/Internet)', 'type' => 'expense']);
        $catExpense2 = Category::create(['name' => 'Gaji Karyawan', 'type' => 'expense']);
        $catExpense3 = Category::create(['name' => 'Pembelian Aset', 'type' => 'expense']);

        // 3. Create Employees
        $emp1 = Employee::create([
            'user_id' => $karyawan1->id,
            'name' => 'Andi Karyawan',
            'position' => 'Developer',
            'base_salary' => 8000000.00,
            'allowance' => 1000000.00,
        ]);

        $emp2 = Employee::create([
            'user_id' => $karyawan2->id,
            'name' => 'Bambang Karyawan',
            'position' => 'UI/UX Designer',
            'base_salary' => 6000000.00,
            'allowance' => 500000.00,
        ]);

        $empDzaki = Employee::create([
            'user_id' => $karyawanDzaki->id,
            'name' => 'Dzaki',
            'position' => 'Senior Developer',
            'base_salary' => 9500000.00,
            'allowance' => 1200000.00,
        ]);

        $empAfifah = Employee::create([
            'user_id' => $karyawanAfifah->id,
            'name' => 'Afifah',
            'position' => 'Lead Designer',
            'base_salary' => 8500000.00,
            'allowance' => 1000000.00,
        ]);

        $empRaka = Employee::create([
            'user_id' => $karyawanRaka->id,
            'name' => 'Raka',
            'position' => 'Content Writer',
            'base_salary' => 5500000.00,
            'allowance' => 500000.00,
        ]);

        $empFikri = Employee::create([
            'user_id' => $karyawanFikri->id,
            'name' => 'Fikri',
            'position' => 'Marketing Specialist',
            'base_salary' => 6000000.00,
            'allowance' => 600000.00,
        ]);

        $empSatria = Employee::create([
            'user_id' => $karyawanSatria->id,
            'name' => 'Satria',
            'position' => 'Customer Support',
            'base_salary' => 5000000.00,
            'allowance' => 400000.00,
        ]);

        $empFajar = Employee::create([
            'user_id' => $karyawanFajar->id,
            'name' => 'Fajar',
            'position' => 'SEO Specialist',
            'base_salary' => 5800000.00,
            'allowance' => 500000.00,
        ]);

        // 4. Create Transactions
        Transaction::create([
            'category_id' => $catIncome1->id,
            'type' => 'income',
            'amount' => 25000000.00,
            'description' => 'Penjualan Batch A',
            'date' => now()->subDays(5)->format('Y-m-d'),
            'user_id' => $finance->id,
        ]);

        Transaction::create([
            'category_id' => $catIncome2->id,
            'type' => 'income',
            'amount' => 12000000.00,
            'description' => 'Jasa maintenance sistem client XYZ',
            'date' => now()->subDays(2)->format('Y-m-d'),
            'user_id' => $finance->id,
        ]);

        Transaction::create([
            'category_id' => $catExpense1->id,
            'type' => 'expense',
            'amount' => 1500000.00,
            'description' => 'Bayar internet & listrik kantor',
            'date' => now()->subDays(10)->format('Y-m-d'),
            'user_id' => $finance->id,
        ]);

        // 5. Create Attendances for September 2026
        $monthSep = '2026-09';
        // Andi: 15 days present (some overtime), 3 days absent (alpa)
        for ($day = 1; $day <= 15; $day++) {
            Attendance::create([
                'employee_id' => $emp1->id,
                'date' => "$monthSep-" . str_pad($day, 2, '0', STR_PAD_LEFT),
                'status' => 'present',
                'check_in_time' => '08:00',
                'check_out_time' => $day % 5 === 0 ? '19:00' : '17:00', // 2 hours overtime every 5 days (total 6 hours)
                'overtime_hours' => $day % 5 === 0 ? 2 : 0,
            ]);
        }
        for ($day = 16; $day <= 18; $day++) {
            Attendance::create([
                'employee_id' => $emp1->id,
                'date' => "$monthSep-" . str_pad($day, 2, '0', STR_PAD_LEFT),
                'status' => 'absent',
                'check_in_time' => '',
                'check_out_time' => '',
                'overtime_hours' => 0,
            ]);
        }

        // Bambang: 18 days present, 0 days absent
        for ($day = 1; $day <= 18; $day++) {
            Attendance::create([
                'employee_id' => $emp2->id,
                'date' => "$monthSep-" . str_pad($day, 2, '0', STR_PAD_LEFT),
                'status' => 'present',
                'check_in_time' => '08:00',
                'check_out_time' => '17:00',
                'overtime_hours' => 0,
            ]);
        }

        // Dzaki, Afifah, Raka, Fikri, Satria, Fajar: 16 days present, 2 days absent
        $newEmps = [$empDzaki, $empAfifah, $empRaka, $empFikri, $empSatria, $empFajar];
        foreach ($newEmps as $emp) {
            for ($day = 1; $day <= 16; $day++) {
                Attendance::create([
                    'employee_id' => $emp->id,
                    'date' => "$monthSep-" . str_pad($day, 2, '0', STR_PAD_LEFT),
                    'status' => 'present',
                    'check_in_time' => '08:00',
                    'check_out_time' => '17:00',
                    'overtime_hours' => 0,
                ]);
            }
            for ($day = 17; $day <= 18; $day++) {
                Attendance::create([
                    'employee_id' => $emp->id,
                    'date' => "$monthSep-" . str_pad($day, 2, '0', STR_PAD_LEFT),
                    'status' => 'absent',
                    'check_in_time' => '',
                    'check_out_time' => '',
                    'overtime_hours' => 0,
                ]);
            }
        }

        // 6. Create Purchase Requests
        PurchaseRequest::create([
            'title' => 'Lisensi Figma Pro',
            'amount' => 450000.00,
            'description' => 'Request lisensi Figma untuk Bambang UI/UX',
            'status' => 'pending',
            'user_id' => $karyawan2->id,
        ]);

        PurchaseRequest::create([
            'title' => 'RAM Upgrade 16GB',
            'amount' => 800000.00,
            'description' => 'Upgrade RAM laptop Developer Andi',
            'status' => 'approved',
            'user_id' => $karyawan1->id,
            'approved_by' => $owner->id,
        ]);
    }
}
