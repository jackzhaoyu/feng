<?php
// 步骤1.设置appid和appsecret
$appid = 'wxce665d3029b340fc';
$appsecret = '2755ff49f821f2abdeedd45b6036c182';

// 步骤2.生成签名的随机串
function nonceStr($length){
    $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';//62个字符
    $strlen = 62;
    while($length > $strlen){
        $str .= $str;
        $strlen += 62;
    }
    $str = str_shuffle($str);
    return substr($str,0,$length);
}

// 步骤3.获取access_token
 
$result = http_get('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret);
$json = json_decode($result,true);
$access_token = $json['access_token'];


function http_get($url){
    $oCurl = curl_init();
    if(stripos($url,"https://")!==FALSE){
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if(intval($aStatus["http_code"])==200){
        return $sContent;
    }else{
        return false;
    }
}


// 步骤4.获取ticket
// https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=ACCESS_TOKEN&type=jsapi
$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=".$access_token;
$res = json_decode ( http_get ( $url ) );
$ticket = $res->ticket;

function getWxConfig($appid,$ticket,$url,$timestamp,$nonceStr) {
    $string = "jsapi_ticket=$ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
    $signature = sha1 ( $string );
    $WxConfig["appId"] = $appid;
    $WxConfig["nonceStr"] = $nonceStr;
    $WxConfig["timestamp"] = $timestamp;
    $WxConfig["url"] = $url;
    $WxConfig["signature"] = $signature;
    $WxConfig["rawString"] = $string;
    return $WxConfig;
}

// 步骤5.生成wx.config需要的参数
$surl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$ws = getWxConfig( $appid,$ticket,$surl,time(),nonceStr(16) );
?>
