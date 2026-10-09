<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $akun = [
            ['Admin', 'admin@laundry.lido', 'adm12345', 'admin'],
            ['Staf', 'staf@laundry.lido', 'staf12345', 'staf'],
        ];

        foreach ($akun as [$nama, $email, $password, $role]) {
            $user = User::firstOrNew(['email' => $email]);
            $user->name = $nama;
            $user->password = Hash::make($password);
            $user->role = $role;
            $user->save();
        }

        $this->call(PriceSeeder::class);
    }
}