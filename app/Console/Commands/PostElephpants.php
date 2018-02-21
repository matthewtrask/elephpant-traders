<?php

namespace App\Console\Commands;

use App\Mail\PostAnElephpant;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class PostElephpants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elephpant:trade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email users to post elephpants';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::notEmailed()->get();

        return $users->each(function ($user) {
            if ($user->posts->count() === 0) {
                Mail::to($user->email())->send(new PostAnElephpant());
            }
        });
    }
}
