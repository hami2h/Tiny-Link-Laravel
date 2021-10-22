<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $this->createAdminUser();
        $this->createManagerUser();
        $this->createUser();
    }

    private function createAdminUser()
    {
        User::create([
            'name'  => "admin",
            'email' => "admin@hami.com",
            'password' => bcrypt('123456'),
            'type' => User::TYPE_ADMIN
        ])->markEmailAsVerified();
    }
    private function createManagerUser()
    {
        User::create([
            'name'  => "manager",
            'email' => "manager@hami.com",
            'password' => bcrypt('123456'),
            'type' => User::TYPE_MANAGER
        ])->markEmailAsVerified();
    }
    private function createUser()
    {
        User::create([
            'name'  => "user",
            'email' => "user@hami.com",
            'password' => bcrypt('123456'),
            'type' => User::TYPE_USER
        ])->markEmailAsVerified();
    }
}
