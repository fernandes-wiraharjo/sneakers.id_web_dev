<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $role = \App\Models\Role::first();
        \App\Models\User::factory(10)->create()
            ->each(function($user) use ($role) {
            $user->roles()->sync([$role->id]);
            });
        $admin = \App\Models\User::create([
            'email' => 'evert87@example.net',
            'name'  => 'Administrator',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $admin->roles()->sync([$role->id]);
    }
}
