<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppFresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fresh application';

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
        exec('git fetch origin master');
        $this->info("Git fetched\n");

        exec('git pull origin master');
        $this->info("Git pulled\n");

        exec('composer dump-autoload');
        $this->info("Files autoload refreshed\n");

        \Artisan::call("optimize:clear");
        $this->info("Cache cleared\n");

    }
}
