<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init';

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
        if (! file_exists(base_path('.env'))) {
            copy(base_path('.env.example'), base_path('.env'));
        }

        if (! config('app.key')) {
            $this->call('key:generate');
        }

        shell_exec('wget https://gist.githubusercontent.com/ben182/14d7393224781764dc5e3315896d6161/raw/00e9b7dfe236fef14898d24a4600911666e504df/pre-commit -O .git/hooks/pre-commit');
        shell_exec('chmod +x .git/hooks/pre-commit');
    }
}
