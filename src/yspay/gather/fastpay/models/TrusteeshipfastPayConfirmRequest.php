<?php

namespace Yspay\SDK\Model;


use Yspay\SDK\Gathering\Kernel\Validator;



class TrusteeshipfastPayConfirmRequest
{

    /**
     * 支付接口生成的支付流水号
     */
    public $paysn;

    /**
     * 验证码
     */
    public $mobile_verify_code;



    public $tran_type; #mozic fix
    public $proxy_password; #mozic fix
    public $merchant_usercode; #mozic fix



    public static function getParam($model)
    {

        $param = array(
            'paysn' => $model->paysn,
            'mobile_verify_code' => $model->mobile_verify_code,
        );

        return $param;
    }


    public static function getCheckRules()
    {

        $checkRules = array(
            'trusteeshipfastPayConfirmRequest' => [
                'paysn' => [
                    Validator::MAX_LEN => 32,
                ],
                'paysn' => [
                    Validator::MAX_LEN => 10,
                ],
            ],

        );

        return $checkRules['trusteeshipfastPayConfirmRequest'];
    }

    public static function build($kernel, $model)
    {

        $bizReqJson = array(
            "paysn" => $model->paysn,
            "mobile_verify_code" => $model->mobile_verify_code,
        );

        return $bizReqJson;
    }

    /**
     * des加密函数
     */
    public static function encryptDes($input, $key)
    {
        if (!isset($input) || !isset($key)) {
            return "";
        }
        $key = substr($key, 0, 8);
        if (iconv_strlen($key,"UTF-8") < 8) {
            $key = sprintf("%+8s", $key);
        }

        $data = openssl_encrypt($input, 'DES-ECB', $key, OPENSSL_RAW_DATA, "");
        $data = base64_encode($data);
        return $data;
    }
}
