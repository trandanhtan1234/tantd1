<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\models\users;
use App\Notifications\NotifyInactiveUser;

class InactiveUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:inactiveUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to inactive user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $limit = \Carbon\Carbon::now()->subday(3);
        $inactiveUser = users::where('last_login', '<', $limit)->get();
        foreach ($inactiveUser as $user) {
            // dd($user);
            $user->notify(new NotifyInactiveUser());
        }
    }
}
