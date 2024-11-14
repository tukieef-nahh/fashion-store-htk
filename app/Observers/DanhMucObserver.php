<?php

namespace App\Observers;

use App\Models\DanhMuc;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

/**
 * Advice-Log::info
 */

//PointCut
class DanhMucObserver
{
    /**
     * Handle the DanhMuc "created" event.
     */
    public function created(DanhMuc $danhMuc)
    {
        Log::info('DanhMuc created:', ['id' => $danhMuc->id, 'data' => $danhMuc]);
    }

    /**
     * Handle the DanhMuc "updated" event.
     */
    public function updated(DanhMuc $danhMuc)
    {       
        Log::info('DanhMuc updated:', ['id' => $danhMuc->id, 'data' => $danhMuc]);
        Cache::forget("danhMuc_{$danhMuc->id}");
        Cache::remember("danhMuc_{$danhMuc->id}", 3600, function () use ($danhMuc) {
            return $danhMuc;
        });
    }

    /**
     * Handle the DanhMuc "deleted" event.
     */
    public function deleted(DanhMuc $danhMuc)
    {
        Log::info('DanhMuc deleted:', ['id' => $danhMuc->id]);
        Cache::forget("danhMuc_{$danhMuc->id}");
    }

    /**
     * Handle the DanhMuc "restored" event.
     */
    public function restored(DanhMuc $danhMuc): void
    {
        //
    }

    /**
     * Handle the DanhMuc "force deleted" event.
     */
    public function forceDeleted(DanhMuc $danhMuc): void
    {
        //
    }
}
