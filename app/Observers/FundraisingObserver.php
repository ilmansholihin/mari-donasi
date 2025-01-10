<?php

namespace App\Observers;

use App\Models\Fundraising;

class FundraisingObserver
{

    /**
     * Handle the Fundraising "saving" event.
     *
     * @param  \App\Models\Fundraising  $fundraising
     * @return void
     */
    /**
     * Handle the Fundraising "created" event.
     */
    public function created(Fundraising $fundraising): void
    {
        //
    }

    public function saving(Fundraising $fundraising)
    {
        // Cek apakah donasi_terkumpul sudah mencapai atau lebih besar dari target_donasi
        if ($fundraising->donasi_terkumpul >= $fundraising->target_donasi) {
            $fundraising->has_finished = 1;
        } else {
            $fundraising->has_finished = 0;
        }
    }

    /**
     * Handle the Fundraising "updated" event.
     */
    public function updated(Fundraising $fundraising): void
    {
        //
    }

    /**
     * Handle the Fundraising "deleted" event.
     */
    public function deleted(Fundraising $fundraising): void
    {
        //
    }

    /**
     * Handle the Fundraising "restored" event.
     */
    public function restored(Fundraising $fundraising): void
    {
        //
    }

    /**
     * Handle the Fundraising "force deleted" event.
     */
    public function forceDeleted(Fundraising $fundraising): void
    {
        //
    }
}
