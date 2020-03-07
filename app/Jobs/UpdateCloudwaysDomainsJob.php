<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Http\Api\CloudwaysApi;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateCloudwaysDomainsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $client;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CloudwaysApi $client)
    {
        $this->client = $client;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->client->addDomain();
        $this->client->addCertificate();
    }
}
