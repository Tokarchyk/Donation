<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Donation;

class DeleteOldDonation implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $targetDate;

    public function __construct($targetDate)
    {
        $this->targetDate = $targetDate;
    }

    public function handle(): void
    {
        Log::info('Start to remove records for date: ' . $this->targetDate);

        $startOfDay = Carbon::parse($this->targetDate)->startOfDay();

        $endOfDay = Carbon::parse($this->targetDate)->endOfDay();

        $deleteEntryForToday = Donation::where('date', '>=', $startOfDay)
                                ->where('date', '<=', $endOfDay)
                                ->delete();

        Log::info('Records for today ' . $this->targetDate . ' successfully deleted');
    }
}
