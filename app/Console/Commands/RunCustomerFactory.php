<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;

class RunCustomerFactory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factory:customers {count=1500}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the Customer Factory to generate records';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = $this->argument('count');
        Customer::factory()->count($count)->create();

        $this->info("$count customers have been generated successfully.");
        return 0;
    }
}
