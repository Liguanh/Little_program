<?php

namespace App\Tools;

/**
 * 
 */
class ToolsCurl
{
	
	
	/* @desc 设置curl的http请求
     * @param $url 请求地址
     * @param string $method 请求方式 GET|POST
     * @param array $data 请求数据，post
     * @return array
     */
    public static function  httpCurl($url, $method="get", $data =[])
    {
        //初始化curl
        $curl = curl_init();

        //设置抓取数据的地址
        curl_setopt($curl, CURLOPT_URL, $url);

        //设置文件流形式返回抓取的数据
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        if($method == "post"){
            //设置post方式请求数据
            curl_setopt($curl, CURLOPT_POST, true);

            //传递post请求的数据
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        //执行curl操作
        $output = curl_exec($curl);

        //关闭释放curl资源
        curl_close($curl);

        return json_decode($output,true);
    }
}