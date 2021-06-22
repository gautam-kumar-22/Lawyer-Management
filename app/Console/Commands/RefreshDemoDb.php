<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Setting\Database\Seeders\ConfigTableSeeder;
use Illuminate\Support\Facades\Artisan;

class RefreshDemoDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:refresh';

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
        Artisan::call('down');
        Artisan::call('migrate:fresh',['--force' => true]);
        Artisan::call('db:seed',['--class' => ConfigTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', array('--force' => true));

        Artisan::call('up');


    }
}
