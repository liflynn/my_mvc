<?php

/**
 * Wget Curl驱动核心
 *
 * @author     jonwang(jonwang@myqee.com)
 * @category   MyQEE
 * @package    System
 * @subpackage Core
 * @copyright  Copyright (c) 2008-2012 myqee.com
 * @license    http://www.myqee.com/license.html
 */

class curl
{
    function post($data,$timeout = 100){
        $headers=array(
            "Content-type: application/json;charset=utf-8",
            "Accept: application/json",
            "Cache-Control: no-cache",
            "Pragma: no-cache"
        );
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL,$data['url']);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data['data']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT,$timeout);
        $tmpInfo=curl_exec($ch);
        if(curl_errno($ch)){
            return curl_error($ch);
        }
        curl_close($ch);
        return $tmpInfo;

    }


    function get($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }

        curl_close($ch);
        return $tmpInfo;
    }
    function postXmlCurl($xml, $url, $useCert = false, $second = 30)
    {
        //初始化curl
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        if ($useCert == true) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            // 设置证书
            curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'pem');
            //设置证书路径
            curl_setopt($ch, CURLOPT_SSLCERT, getcwd()."/assets/wx_cert/apiclient_cert.pem");
            curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'pem');
            curl_setopt($ch, CURLOPT_SSLKEY, getcwd()."/assets/wx_cert/apiclient_key.pem");

        }else{
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //运行curl
        $data = curl_exec($ch);
        curl_close($ch);
        //返回结果
        return $data;
    }

    function postXml($params,$url,$useCert=false)
    {
        //生成xml数据
        $xml = $this->createXml($params);
        //发送curl
        $res = $this->postXmlCurl($xml,$url,$useCert);

        return $this->xmlToArray($res);
    }

// 设置标配的请求参数，生成签名，生成接口参数xml
    function createXml($params)
    {

        $res = $this->arrayToXml($params);
        return $res;
    }

    function xmlToArray($xml)
    {
        //将XML转为array
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $array_data;
    }

    function arrayToXml($arr)
    {

        $xml = "<xml>";
        foreach ($arr as $key=>$val)
        {
            if(is_array($val)){

                $xml.="<".$key.">".arrayToXml($val)."</".$key.">";

            }else{

                if (is_numeric($val))
                {
                    $xml.="<".$key.">".$val."</".$key.">";
                }
                else
                {
                    $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
                }
            }

        }
        $xml.= "</xml>";
        return $xml;
    }

}