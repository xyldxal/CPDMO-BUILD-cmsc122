<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SystemUser;

class CreateUser extends Command
{
    protected $signature = 'user:create';
    protected $description = 'Create a new user';

    public function handle()
    {
        $username = $this->ask('Enter user name');
        $email = $this->ask('Enter user email');
        $password = $this->secret('Enter user password');

        $user = SystemUser::create([
            'username' => $username,
            'email' => $email,
            'password' => bcrypt($password),
            'token' => "20f1d5aa6a74ec3ec1225ac9abfd02678b9f82be23b81be8c5aaa2633982b9ad",
            'unit' => 'CAS'
            // Add other fields as needed
        ]);

        $this->info('User created successfully!');
    }
}