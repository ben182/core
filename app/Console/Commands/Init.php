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
        if (str_contains(php_uname('s'), 'Windows')) {
            return $this->error('Command must be executed on a bash shell');
        }

        if (! file_exists(base_path('.env'))) {
            copy(base_path('.env.example'), base_path('.env'));
        }

        if (! config('app.key')) {
            $this->call('key:generate');
        }

        shell_exec('wget https://gist.githubusercontent.com/YP28/527415377bbaa212467088f85b752136/raw/pre-commit -O .git/hooks/pre-commit');
        shell_exec('chmod +x .git/hooks/pre-commit');
    }
}
