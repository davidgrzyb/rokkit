<?php

namespace App\Console\Commands;

use App\Link;
use App\Click;
use Illuminate\Console\Command;

class CreateClicksForLinksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clicks:create';

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
     * @return mixed
     */
    public function handle()
    {
        // $file = \Illuminate\Support\Facades\File::get(base_path().'/noomio-clicks');

        $clicks = [];

        $file = fopen('noomio-clicks', 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
            array_push($clicks, [
                $line[0],
                $line[1]
            ]);
        }
        fclose($file);
    
        foreach ($clicks as $click) {
            $link = Link::where('slug', $click[0])->first();

            if (! $link) {
                continue;
            }

            for ($i = 0 ; $i < $click[1]; $i++) {
                Click::insert([
                    'link_id' => $link->id,
                    'created_at' => now()->subMonth(2),
                ]);
            }
        }
    }
}
