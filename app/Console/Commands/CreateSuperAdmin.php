<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Backend\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:super-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bringing Super Admin User';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::create([
            'username' => 'shahadat',
            'fname' => 'Shahadat',
            'lname' => 'Hossen',
            'email' => 'shobuj@bansberrysg.com',
            'email_verified_at' => Carbon::now(),
            'status_id' => 1,
            'password' => Hash::make('sdkShobuj91')
        ]);

        $role = 'Super Admin';
        if($user->assignRole($role)){
            $this->info("Super admin created successfully");
        }
    }
}
