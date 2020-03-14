<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Api\CloudwaysApiInterface;

class UpdateDomainsAndCertificatesInCloudwaysCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cloudways:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update domains and SSL certificate in Cloudways.';

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
    public function handle(CloudwaysApiInterface $client)
    {
        $client->addDomain();
        $client->addCertificate();
    }
}
