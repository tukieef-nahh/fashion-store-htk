<?php

namespace App\Listeners;

use App\Events\ThuongHieuActionPerformed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class LogThuongHieuAction
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    //Advice 
    public function handle(ThuongHieuActionPerformed $event)
    {
        $userName = $event->user->name;
        $userId = $event->user->id;
        $action = $event->action;

        Log::info("Action: {$userName} (ID: {$userId}) đã thực hiện thao tác: {$action} trên một thương hiệu.");
    }
}
