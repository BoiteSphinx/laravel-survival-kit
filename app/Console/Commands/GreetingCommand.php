<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GreetingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'survival-kit:greetings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Greets the user, otherwise the company.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Bonjour ' . config('survival-kit.default_user.name', 'Adhex') . ' !');

        return self::SUCCESS;
    }
}
