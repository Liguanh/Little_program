<?php

namespace App\Listeners;

use App\Events\RegisterSuccess;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateInvite
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RegisterSuccess  $event
     * @return void
     */
    public function handle(RegisterSuccess $event)
    {
        //
        \Log::info('测试注册成功建立邀请管理的监听器',[$event->data]);
        //dd($event->data);
    }
}
