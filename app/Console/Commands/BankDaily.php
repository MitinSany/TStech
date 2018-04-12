<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BankService;

class BankDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bank:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bank daily actions';
    protected $bankService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(BankService $bankService)
    {
        parent::__construct();
        $this->bankService = $bankService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo  $this->bankService->doDailyTasks() . PHP_EOL;
    }
}
