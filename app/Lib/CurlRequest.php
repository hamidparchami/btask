<?php
/**
 * Created by PhpStorm.
 * User: hamid
 * Date: 12/31/16
 * Time: 6:21 PM
 */

namespace App\Lib;


use Illuminate\Support\Facades\Log;

class CurlRequest
{
    public $curl_headers = array();
    public $log_parameters = '';

    public function setCurlHeaders($header) {
        $this->curl_headers[] = $header;
    }

    public function getCurlHeaders()
    {
        return $this->curl_headers;
    }

    public function setLogParameters($info, $parameter)
    {
        $this->log_parameters .= sprintf("'%s' => %s, ", $parameter, $info[$parameter]);
    }
    public function setCurlLog(array $info)
    {
        $this->setLogParameters($info, 'url');
        $this->setLogParameters($info, 'http_code');
        $this->setLogParameters($info, 'total_time');
        $this->setLogParameters($info, 'primary_ip');
        $this->setLogParameters($info, 'local_ip');
        //set curl request log
        Log::useDailyFiles(storage_path().'/logs/curl.log');
        Log::info($this->log_parameters);
    }

    public function sendCurlRequest($url, $params = null, $method = 'post')
    {
        $curl_request = curl_init($url);
        curl_setopt($curl_request, ($method == 'post') ? CURLOPT_POST : CURLOPT_HTTPGET, 1);
        curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_request, CURLOPT_HEADER, 0);
        curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_request, CURLOPT_HTTPHEADER, $this->getCurlHeaders()); //CURL Headers (array)
        if($method == 'post' && !is_null($params)) {
            curl_setopt($curl_request, CURLOPT_POSTFIELDS, $params);
        }
        $response = curl_exec($curl_request);
        $status = curl_getinfo($curl_request, CURLINFO_HTTP_CODE);

        //set curl request log
        $info = curl_getinfo($curl_request);
        $this->setCurlLog($info);

        curl_close($curl_request);
        return ($status == 200) ? json_decode($response) : false;
    }
}