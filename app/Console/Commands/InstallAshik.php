<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class InstallAshik extends Command
{
    protected $signature = 'ashik:install';
    protected $description = 'Install and configure the application in one step.';

    public function handle(): int
    {
        $this->info('🚀 Starting the Installation Process...');

        // Step 0: Copy .env.ashik to .env
        $this->copyEnvFile();

        // Step 0.5: Generate app key
        $this->generateAppKey();

        $this->prepareSetupWizard();

        $this->info('🎉 Installation completed successfully!');
        return Command::SUCCESS;
    }

    private function copyEnvFile(): void
    {
        $source = base_path('.env.ashik');
        $destination = base_path('.env');

        if (!File::exists($source)) {
            $this->error("❌ .env.ashik file not found at {$source}");
            return;
        }

        if (File::exists($destination)) {
            $this->info(".env file already exists, backing it up to .env.bak");
            File::move($destination, base_path('.env.bak'));
        }

        File::copy($source, $destination);
        $this->info("✅ Copied .env.ashik to .env");
    }

    private function generateAppKey(): void
    {
        $this->info('🔑 Generating application key...');
        Artisan::call('key:generate');
        $this->info('✅ Application key generated.');
    }

    private function prepareSetupWizard(): void
    {
        $publicPath = public_path('index.php');
        $productionPath = public_path('index.php.production');

        // Step 1: If index.php exists, rename it to index.php.production
        if (File::exists($publicPath)) {
            File::move($publicPath, $productionPath);
            $this->info("🔄 Renamed index.php → index.php.production");
        }

        // Step 2: Read the stub file from base_path
        $stubPath = base_path('stubs/setup-wizard.stub');
        if (!File::exists($stubPath)) {
            $this->error("❌ Stub file not found at {$stubPath}");
            return;
        }

        $wizardCode = File::get($stubPath);

        // Step 3: Write the wizard code into public/index.php
        File::put($publicPath, $wizardCode);
        $this->info("📄 Created new setup wizard at public/index.php");
    }
}
