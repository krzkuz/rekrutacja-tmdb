<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TMDBData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TMDBData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrations and seed db tables';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Running migrations...');

        $this->call('migrate');

        $this->info('Seeding database...');

        $this->call('db:seed');

        $this->info('TMDB data fetched and stored successfully.');
    }
}
