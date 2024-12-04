<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class DeployApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy:application';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automates the deployment process for the application.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Starting deployment process...');

        try {
            // Run composer install
            $this->runProcess(['composer', 'install', '--no-dev', '--optimize-autoloader']);

            // Run database migrations
            Artisan::call('migrate', ['--force' => true]);
            $this->info(Artisan::output());

            // Clear caches
            Artisan::call('optimize:clear');
            $this->info('Caches cleared.');

            // Create storage symlink
            Artisan::call('storage:link');
            $this->info('Storage symlink created.');

             //generate passport keys
            Artisan::call('passport:keys');

            //Run the custom passport access-clients passport keys
            $this->call('passport:create-personal-access-clients');

            // Set appropriate permissions
            // $this->runProcess(['chown', '-R', 'gamekrlp:gamekrlp', base_path()]);
            // $this->runProcess(['chmod', '-R', '775', storage_path(), base_path('bootstrap/cache')]);
            // $this->info('Permissions set.');

            $this->info('Deployment process completed successfully.');
        } catch (\Exception $e) {
            $this->error('Deployment failed: ' . $e->getMessage());
        }
    }

    /**
     * Run an external process and handle its output.
     *
     * @param array $command
     * @return void
     */
    private function runProcess(array $command): void
    {
        $process = new Process($command);
        $process->setWorkingDirectory(base_path());
        $process->setTimeout(300);

        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                $this->error($buffer);
            } else {
                $this->line($buffer);
            }
        });

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
    }
}