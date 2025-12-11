<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $name = $this->ask('Enter_Your_Admin_Name');
        $email = $this->ask('Enter_Your_Admin_Email');
        $password = $this->secret('Enter_Your_Admin_Password');

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->info("Admin Created Successfully! Name: {$user->name}");
    }
}
