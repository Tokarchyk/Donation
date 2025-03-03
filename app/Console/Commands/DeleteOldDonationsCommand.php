<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Donation;

class DeleteOldDonationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'donations:delete
                            {date : Date to delete records (format: d)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete donations records for the specified date';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $date = $this->argument('date');

        $olderThanMonth = Carbon::now()->subDays($date);

        Donation::where('date', '<', $olderThanMonth)->delete();

        Log::info('Records for' . $olderThanMonth .  'successfully deleted');
    }
}
