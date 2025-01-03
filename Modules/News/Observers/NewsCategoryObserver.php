<?php

namespace Modules\News\Observers;

use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Modules\News\Entities\NewsCategory;

class NewsCategoryObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the NewsCategory "created" event.
     */
    public function created(NewsCategory $newscategory): void
    {
        //
    }

    /**
     * Handle the NewsCategory "updated" event.
     */
    public function updated(NewsCategory $newscategory): void
    {
        //
    }

    /**
     * Handle the NewsCategory "deleted" event.
     */
    public function deleted(NewsCategory $newscategory): void
    {
        //
    }

    /**
     * Handle the NewsCategory "restored" event.
     */
    public function restored(NewsCategory $newscategory): void
    {
        //
    }

    /**
     * Handle the NewsCategory "force deleted" event.
     */
    public function forceDeleted(NewsCategory $newscategory): void
    {
        //
    }
}
