<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Tools\ToolsEmail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send_email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '发送邮件1';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //

        $emailData = [
            'subject' => '测试发邮件',
            'content' => "测试laravel的任务调度控制台",
            'email_address' => '872947247@qq.com'
        ];

        ToolsEmail::sendEmail($emailData);
    }
}
