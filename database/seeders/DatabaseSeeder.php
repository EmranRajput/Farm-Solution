<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'name' => 'Haider',
            'email' => 'haideraliali1233@gmail.com',
           // 'birthday' => '2001-01-01',
            'role' => '1',
            'password' => Hash::make('admin123')
        ]);
    }
}
