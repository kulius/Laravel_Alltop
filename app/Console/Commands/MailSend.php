<?php

namespace App\Console\Commands;

use App\Database\eOffice\SysMailSend;
use App\Database\eOffice\SysMailSendLog;
use Config;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MailSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $school = "demo.ini";

        $ini_path = base_path() . '/database/connections/';

        $ini = parse_ini_file($ini_path . $school, true);

        foreach ($ini as $db => $info) {
            if (is_array($info)) {
                //清除
                //DB::purge($db);
                //設置
                foreach ($info as $set => $content) {
                    Config::set("database.connections.{$db}.{$set}", $content);
                }
                //連接
                // DB::reconnect($db);
                //測試
                //Schema::connection($db)->getConnection()->reconnect();
            }
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $where   = array();
        $where[] = array('mail_send_status', '=', '0');

        $data_mail = SysMailSend::where($where)->get();
        $send_mail = array();
        $send      = 1;

        foreach ($data_mail as $_key => $_value) {
            if ($send > 300) {
                break;
            } else {
                $seq               = $_value['seq'];
                $mail_to_user_name = $_value['mail_to_user_name'];
                $mail_content      = $_value['mail_content'];

                // 信件發送
                Mail::send('mail', array('mail_content' => $mail_content), function ($message) use ($_value) {
                    $mail_from_address   = $_value['mail_from_address'];
                    $mail_form_user_name = $_value['mail_form_user_name'];
                    $mail_to_address     = $_value['mail_to_address'];
                    $mail_reply_to       = $_value['mail_reply_to'];
                    $mail_subject        = $_value['mail_subject'];

                    $message->to($mail_to_address);
                    $message->subject($mail_subject);
                });

                $send_mail[] = array(
                    "mail_send_seq" => $seq,
                );

                $send++;
            }
        }

        // 更改狀態
        SysMailSend::whereIn('seq', $send_mail)->update(array('mail_send_status' => '1'));

        // 發送Log
        SysMailSendLog::insert($send_mail);
    }
}
