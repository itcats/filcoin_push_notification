<?php
// +----------------------------------------------------------------------
// | Created by PhoStorm
// +----------------------------------------------------------------------
// | Author: ▌遇到つ <364280595@qq.com>
// +----------------------------------------------------------------------
// | Date:   2022-01-01 12:37:34
// +----------------------------------------------------------------------

$send_key = getenv('SEND_KEY');

/**
 * server酱推送消息
 * @param $usdt
 * @param $send_key
 * @param $desp
 * @return false|string
 */
function sc_send($usdt, $send_key, $desp = '')
{
    $base_text = 'Filcoin目前价格为：' . $usdt . 'USDT';
    $postdata  = http_build_query(array('text' => $base_text, 'desp' => $desp));
    $opts      = array(
        'http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
    );

    $context = stream_context_create($opts);
    return $result = file_get_contents('https://sctapi.ftqq.com/' . $send_key . '.send', false, $context);
}

$api_url = 'https://api.binance.com/api/v3/ticker/price?symbol=FILUSDT';
/**
 * 获取当前USDT价格
 * @param $api_url
 * @return mixed|string
 */
function get_filcoin_price($api_url)
{
    // get cURL resource
    $ch = curl_init();
// set url
    curl_setopt($ch, CURLOPT_URL, $api_url);
// set method
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// send the request and save response to $response
    $response = curl_exec($ch);
// stop if fails
    if (!$response) {
        return 'Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch);
    }
    curl_close($ch);
    $response = json_decode($response, true);
    return $response['price'];
}

$usdt = get_filcoin_price($api_url);

if ($usdt >= 100) {
    sc_send($usdt, $send_key);
}

