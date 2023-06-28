<?php

if ( !function_exists('formatting_timestamp') ) {
    //把时间戳转换为几分钟或几小时前或几天前
    function formatting_timestamp($time, $show_second = true): string
    {
        $time = (int) substr($time, 0, 10);
        $int  = time() - $time;
        $str  = '';
        if ($int <= 30) {
            $str = sprintf('刚刚', $int);
        } else if ($int < 60) {
            $str = sprintf('%d秒前', $int);
        } else if ($int < 3600) {
            $str = sprintf('%d分钟前', floor($int / 60));
        } else if ($int < 86400) {
            $str = sprintf('%d小时前', floor($int / 3600));
        } else if ($int < 2592000) {
            $str = sprintf('%d天前', floor($int / 86400));
        } else if (date('Y', $time) == date('Y')) {
            $str = date('m-d H:i' . ($show_second ? ':s' : ''), $time);
        } else {
            $str = date('Y-m-d H:i' . ($show_second ? ':s' : ''), $time);
        }
        return $str;
    }
}

if ( !function_exists('get_client_info') ) {
    /**
     * 获取IP与浏览器信息、语言
     *
     * @return array
     */
    function get_client_info() : array
    {
        if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
            $XFF = $_SERVER['HTTP_X_FORWARDED_FOR'];
            $client_pos = strpos($XFF, ', ');
            $client_ip = false !== $client_pos ? substr($XFF, 0, $client_pos) : $XFF;
            unset($XFF, $client_pos);
        } else $client_ip = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['REMOTE_ADDR'] ?? $_SERVER['LOCAL_ADDR'] ?? '0.0.0.0';
        $client_lang = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5) : '';
        $client_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        return [
            'ip'    => &$client_ip,
            'lang'  => &$client_lang,
            'agent' => &$client_agent,
        ];
    }
}

if ( !function_exists('get_ip') ) {
    function get_ip() : string
    {
        $data = get_client_info();
        return $data['ip'] ?? '';
    }
}

/**
 * [check_url]
 *
 * @param  string  $_url  [description]
 *
 * @return             [type]        [description]
 * @author             :cnpscy <[2278757482@qq.com]>
 * @chineseAnnotation  :检测URL地址格式
 * @englishAnnotation  :
 * @version            :1.0
 */
if ( !function_exists('check_url') ) {
    function check_url(string $url) : bool
    {
        $str = "/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/";
        if ( !preg_match($str, $url) ) return false; else return true;
    }
}


if ( !function_exists('my_json_encode') ) {
    /**
     * 统一的json_encode
     *
     * @param  array   $data
     * @param  string  $options
     *
     * @return false|string
     */
    function my_json_encode($data, string $options = '')
    {
        //$data = is_object($data) ? (array)$data : $data;
        return json_encode($data, empty($options) ? (JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : $options);
    }
}

if ( !function_exists('my_json_decode') ) {
    /**
     * 统一的 json_decode
     *
     * @param  string  $string
     * @param  bool    $assoc
     *
     * @return mixed
     */
    function my_json_decode(string $string, bool $assoc = true)
    {
        return json_decode($string, $assoc);
    }
}
