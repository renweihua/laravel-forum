<?php

if ( !function_exists('hash_make') ) {
    /**
     * hash加密
     *
     * @param  string  $password
     *
     * @return string
     */
    function hash_make(string $password = '123456') : string
    {
        return hash_encryption($password);
    }
}

if ( !function_exists('hash_encryption') ) {
    /**
     * [hash_encryption]
     *
     * @param  string  $pass  [description]
     *
     * @return string
     * @author             :cnpscy <[2278757482@qq.com]>
     * @chineseAnnotation  :hash加密
     * @englishAnnotation  :
     * @version            :1.0
     */
    function hash_encryption($pass = '123456') : string
    {
        return password_hash($pass, PASSWORD_DEFAULT);
    }
}

if ( !function_exists('hash_verify') ) {
    /**
     * [hash_verify]
     *
     * @param  string  $pass       [description]
     * @param  string  $hash_pass  [description]
     *
     * @return bool
     * @author             :cnpscy <[2278757482@qq.com]>
     * @chineseAnnotation  :hash解密
     * @englishAnnotation  :
     *
     * @version            :1.0
     */
    function hash_verify(string $pass, string $hash_pass) : bool
    {
        return password_verify($pass, $hash_pass);
    }
}

/**
 * 生成UUID
 *
 * @param  string  $string
 *
 * @return string
 */
if ( !function_exists('get_uuid') ) {
    /**
     * 生成UUID
     *
     * @param  string  $string
     *
     * @return string
     */
    function get_uuid(string $string = '') : string
    {
        $string = '' === $string ? uniqid(mt_rand(), true) : (0 === (int)preg_match('/[A-Z]/', $string) ? $string : mb_strtolower($string, 'UTF-8'));
        $code = hash('sha1', $string . ':UUID');
        $uuid = substr($code, 0, 10);
        $uuid .= substr($code, 10, 4);
        $uuid .= substr($code, 16, 4);
        $uuid .= substr($code, 22, 4);
        $uuid .= substr($code, 28, 12);
        $uuid = strtoupper($uuid);
        unset($string, $code);
        return $uuid;
    }
}

/**
 * Generate UUID (string hash based)
 *
 * @param  string  $string
 *
 * @return string
 */
function make_uuid(string $string = '') : string
{
    if ( '' === $string ) {
        //Create random string
        $string = uniqid(microtime() . getmypid() . mt_rand(), true);
    }

    $start = 0;
    $codes = [];
    $length = [
        8,
        4,
        4,
        4,
        12,
    ];
    $string = hash('md5', $string);

    foreach ($length as $len) {
        $codes[] = substr($string, $start, $len);
        $start += $len;
    }

    $uuid = implode('-', $codes);

    unset($string, $start, $codes, $length, $len);
    return $uuid;
}
