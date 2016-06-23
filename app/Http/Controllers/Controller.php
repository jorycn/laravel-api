<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    // 短信接口地址
    protected $smsApiUrl = 'http://sms-api.luosimao.com/v1/send.json';
    // 短信密钥
    protected $smsApiKey = '9d8de7665c7562787c0cdd2171ebc81c';

    use DispatchesJobs, ValidatesRequests;

    /**
     * 格式化返回接口数据
     *
     * @param $data
     * @param int $status_code
     * @return array
     */
    public function formatJson($data, $status_code = 200)
    {
        return ['data' => $data, 'status_code' => $status_code];
    }

    // 发送短信
    protected function _sendSms($mobile, $message)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->smsApiUrl);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, 'api:key-' . $this->smsApiKey);

        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $mobile, 'message' => $message . '【XX科技】'));

        $res = curl_exec($ch);
        curl_close($ch);

        $res = json_decode($res, true);

        if ($res['error'] == 0 && $res['msg'] == 'ok') {
            return true;
        } else {
            return false;
        }
    }
}
