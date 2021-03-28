<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendGoogleAnalytics extends Command
{
    protected const PATH = 'https://analytics.google.com/g/collect?v=2&tid=G-M8MV83S2JG';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:ga';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send GA';

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $i = 0;

        do {

            $response = $this->client->request('POST', static::PATH, [
                'form_params' => [
                    'dl' => 'http://app.test',
                    'en' => $i % 2 === 0 ? 'even_event' : 'odd_event',
                    'dt' => 'My Laravel',
                    'epn.count' => $i,
                    'epn.some_var' => 'test',
                ]]);

            $i++;
        } while ($i < 10);

        return 0;
    }
}
