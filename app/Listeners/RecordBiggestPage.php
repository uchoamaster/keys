<?php

namespace App\Listeners;

use App\Events\RandomPageGenerated;
use App\Models\BiggestRandomPage;
use Illuminate\Support\Str;

class RecordBiggestPage
{
    public function handle(RandomPageGenerated $event)
    {
        if (! $this->shouldCompareWithDatabase($event)) {
            return;
        }

        $currentBiggest = BiggestRandomPage::biggest($event->coin);

        if ($event->pageNumber > $currentBiggest) {
            BiggestRandomPage::create([
                'coin' => $event->coin,
                'page_number' => $event->pageNumber,
            ]);
        }
    }

    private function shouldCompareWithDatabase($event)
    {
        if (! config('keys.enable_page_number_hardcoded_check')) {
            return true;
        }

        return Str::startsWith($event->pageNumber, '90462');
    }
}
