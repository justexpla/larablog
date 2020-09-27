<?php

namespace App\Observers;

use App\Models\Commentary;
use Illuminate\Support\Facades\Auth;

class CommentaryObserver
{
    /**
     * Handle the commentary "creating" event.
     *
     * @param  \App\Models\Commentary  $commentary
     * @return void
     */
    public function creating(Commentary $commentary)
    {
        $commentary->setAttribute('user_id', Auth::user()->id);
    }

    /**
     * Handle the commentary "created" event.
     *
     * @param  \App\Models\Commentary  $commentary
     * @return void
     */
    public function created(Commentary $commentary)
    {
        //
    }

    /**
     * Handle the commentary "updated" event.
     *
     * @param  \App\Models\Commentary  $commentary
     * @return void
     */
    public function updated(Commentary $commentary)
    {
        //
    }

    /**
     * Handle the commentary "deleted" event.
     *
     * @param  \App\Models\Commentary  $commentary
     * @return void
     */
    public function deleted(Commentary $commentary)
    {
        //
    }

    /**
     * Handle the commentary "restored" event.
     *
     * @param  \App\Models\Commentary  $commentary
     * @return void
     */
    public function restored(Commentary $commentary)
    {
        //
    }

    /**
     * Handle the commentary "force deleted" event.
     *
     * @param  \App\Models\Commentary  $commentary
     * @return void
     */
    public function forceDeleted(Commentary $commentary)
    {
        //
    }
}
