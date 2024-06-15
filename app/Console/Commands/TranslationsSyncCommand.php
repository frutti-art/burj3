<?php

namespace App\Console\Commands;

use App\Models\Translation;
use Illuminate\Console\Command;

class TranslationsSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:translations-sync-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Translations sync command');

        $keys = Translation::getAllKeys();

        foreach ($keys as $key) {
            Translation::firstOrCreate(
                ['key' => $key],
                ['value' => Translation::getDefaultValues()[$key] ?? '']
            );
        }
    }
}
