<?php

namespace App\Listeners;

use App\Events\RegisterSuccess;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendBonus implements ShouldQueue
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
        \Log::info('发送红包的监听器',[$event->data]);

        $userId = $event->data['user_id'];

        $bonusId = $event->data['bonus_id'];

        $bonus = \DB::table('jy_bonus')->where('id', $bonusId)->first();

        $userBonus = [
            'user_id' => $userId,
            'bonus_id' => $bonusId,
            'start_time' => date("Y-m-d H:i:s"),
            'end_time'   => date('Y-m-d H:i:s',strtotime("+ ".$bonus->expires." days"))
        ];

        \Log::info('发送红包的数据',[$userBonus]);

        \DB::table('jy_user_bonus')->insert($userBonus);

    }
}
