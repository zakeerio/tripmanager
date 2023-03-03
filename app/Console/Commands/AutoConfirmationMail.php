<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Mail;
use App\Mail\ConfirmationMail;
use App\Models\User;
use App\Models\Crew;

use Illuminate\Support\Facades\Log;


class AutoConfirmationMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'auto:confirmationmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $user = User::where('email','=', 'zakeerio25@gmail.com')->first();

        Mail::to($user)->send(new ConfirmationMail($user));
        Log::info("TESTING HERE ". date("Y-m-d H:i:s"));
        // $users = Crew::where('confirmed', '=', 'Y')
        // ->get();

        // if ($users->count() > 0) {
        //     foreach ($users as $user) {
        //         Mail::to($user)->send(new ConfirmationMail($user));
        //     }
        // }

        return 0;
    }
}
