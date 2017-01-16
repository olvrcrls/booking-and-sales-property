<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class preload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'preload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refreshes the database then pre-loads database with data.';

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
        $this->call('migrate:refresh', [
                '--force' => true,
            ]);
        $this->call('db:seed', [
                '--force' => true
            ]);
    }
}
