<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Http\Api\CloudwaysApiInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateCloudwaysDomainsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(CloudwaysApiInterface $client)
    {
        $client->addDomain();
        // No longer needed with HTTPS only being required for default domain.
        // $client->addCertificate();
    }
}
