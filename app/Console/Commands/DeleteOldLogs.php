<?php

namespace App\Console\Commands;

use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-logs';

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
        $deleted = Log::where('created_at', '<', Carbon::now()->addDays(2))->delete();
        $this->info("{$deleted} logs apagados.");
    }
}
