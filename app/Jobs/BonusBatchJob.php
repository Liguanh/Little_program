<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Model\UserBonus;
//红包批次发送job类
class BonusBatchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $data = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data=[])
    {
        //定义值
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //直接调用发送红包的操作
        $userBonus = new UserBonus();

        try{
            //执行红包批量发送的操作
            $userBonus->sendBonusMany($this->data['user_id'], $this->data['bonus_id'], $this->data['expires']);
        }catch(\Exception $e){
            
            \Log::error('批量发送红包失败'.$e->getMessage());
        }
        
    }
}
