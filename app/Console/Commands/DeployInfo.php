<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeployInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy:infos';

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
        $sUrl = $this->trim(shell_exec('git config --get remote.origin.url'));
        $sVersion = $this->trim(shell_exec('git describe --tags --abbrev=0'));
        $sHash = $this->trim(shell_exec('git log --pretty="%H" -n1 HEAD'));

        $this->editEnvKey('APP_VERSION', $sVersion);
        config([
            'app.version' => $sVersion,
            'bugsnag.app_version' => $sVersion,
        ]);
        echo 'Set app version to ' . $sVersion . "\n";

        $this->call('bugsnag:deploy', [
            '--repository' => $sUrl,
            '--revision' => $sHash,
        ]);
    }

    protected function trim($string)
    {
        return trim(preg_replace('/\s+/', ' ', $string));
    }

    protected function editEnvKey($sKey, $sValue)
    {
        $sPath = base_path('.env');

        if (! file_exists($sPath)) {
            return false;
        }

        $sFile = file_get_contents($sPath);

        preg_match("/(?<=$sKey=).*/", $sFile, $match);

        if (! isset($match[0])) {
            return false;
        }

        file_put_contents($sPath, str_replace(
            "$sKey=" . $match[0],
            "$sKey=" . $sValue,
            $sFile
        ));

        return true;
    }
}
