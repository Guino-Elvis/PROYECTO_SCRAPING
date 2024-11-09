<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class DeleteUnverifiedUsers extends Command
{
    protected $signature = 'delete:unverified-users';
    protected $description = 'Delete users who have not verified their email within a specified time.';

    public function handle()
    {
        $users = User::whereNull('email_verified_at')->get();

        foreach ($users as $user) {
            $user->delete();
            $this->info('Deleted unverified user: ' . $user->email);
        }
    }
}
