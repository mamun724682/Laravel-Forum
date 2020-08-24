<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Notifications\EmailToInactiveUsers;

class EmailInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to inactive users';

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
     * @return int
     */
    public function handle()
    {
        $limit = Carbon::now()->subDay(7);
        $inactive_users = User::where('last_login', '<', $limit)->get();
        foreach ($inactive_users as $user) {
            $user->notify(new EmailToInactiveUsers());
            $this->info("Sent email to inactive {$user->email}");
        }
    }
}
