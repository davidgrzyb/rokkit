<?php

namespace App\Jobs;

use App\User;
use App\Charge;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class LimitReachedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($user->plan === User::PRO_PLAN) {
            $user->invoiceFor(
                config('rokkit.extra_redirects.title'),
                config('rokkit.extra_redirects.price')
            );

            Charge::create([
                'user_id' => $user->id,
                'description' => config('rokkit.extra_redirects.title'),
                'amount' => config('rokkit.extra_redirects.price'),
            ]);
        } else {
            // TODO: send warning email for free users.
        }
    }
}
