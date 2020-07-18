<?php
declare(strict_types=1);

namespace App\Utils;

/**
 * Class StringUtil
 * @package App\Utils
 */
class StringUtil
{

    /**
     * 生成密码
     * @param string $pass
     * @param string $salt
     * @return string
     */
    public static function generatePassword(string $pass, string $salt): string
    {
        return md5(md5($pass) . md5($salt));
    }

    /**
     * 生成随机字符串
     * @param int $length
     * @return string
     */
    public static function generateRandStr(int $length = 32): string
    {
        mt_srand();
        $md5 = md5(uniqid(md5((string)time())) . mt_rand(10000, 9999999));
        return substr($md5, 0, $length);
    }


    /**
     * 获取数据签名
     * @param array $data
     * @param string $appKey
     * @return string
     */
    public static function generateSignature(array $data, string $appKey): string
    {
        unset($data['sign']);
        ksort($data);
        foreach ($data as $key => $val) {
            if ($val === '') {
                unset($data[$key]);
            }
        }
        return md5(urldecode(http_build_query($data) . "&key=" . $appKey));
    }

    /**
     * 生成订单号
     * @return string
     */
    public static function generateTradeNo()
    {
        mt_srand();
        return date("ymdHis", time()) . mt_rand(100000, 999999);
    }

    /**
     * 随机生成浮动金额
     * @param float $amount
     * @param int $min
     * @param int $max
     * @return float
     */
    public static function generateRandAmount(float $amount, int $min, int $max): float
    {
        mt_srand();
        return $amount + (mt_rand($min, $max) / 100);
    }
}