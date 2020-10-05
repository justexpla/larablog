<?php

namespace App\Observers;

use App\Models\BlackList;

class BlackListObserver
{
    /**
     * Handle the black list "creating" event.
     *
     * @param  \App\Models\BlackList  $blackList
     * @return void
     */
    public function creating(BlackList $blackList)
    {
        $blackList->setAttribute('user_id', auth()->user()->id);
    }

    /**
     * Handle the black list "created" event.
     *
     * @param  \App\Models\BlackList  $blackList
     * @return void
     */
    public function created(BlackList $blackList)
    {
        //
    }

    /**
     * Handle the black list "updated" event.
     *
     * @param  \App\Models\BlackList  $blackList
     * @return void
     */
    public function updated(BlackList $blackList)
    {
        //
    }

    /**
     * Handle the black list "deleted" event.
     *
     * @param  \App\Models\BlackList  $blackList
     * @return void
     */
    public function deleted(BlackList $blackList)
    {
        //
    }

    /**
     * Handle the black list "restored" event.
     *
     * @param  \App\Models\BlackList  $blackList
     * @return void
     */
    public function restored(BlackList $blackList)
    {
        //
    }

    /**
     * Handle the black list "force deleted" event.
     *
     * @param  \App\Models\BlackList  $blackList
     * @return void
     */
    public function forceDeleted(BlackList $blackList)
    {
        //
    }
}
