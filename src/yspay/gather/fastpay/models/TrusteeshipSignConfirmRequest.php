<?php

namespace Yspay\SDK\Model;


use Yspay\SDK\Gathering\Kernel\Validator;

include_once dirname(dirname(dirname(dirname(__FILE__)))) . '\util\Validator.php';


class TrusteeshipSignConfirmRequest
{

    /**
     * 商户生成的订单号
     */
    public $out_trade_no;


    /**
     * 短信验证码
     */
    public $mobile_verify_code;

    /**
     * CVV码，贷记卡必填，使用DES加密，密钥为商户号前8位，不足8位在商户号前补空格
     */
    public $cardCvn2;

    /**
     * 有效日期, MMYY，使用DES加密，密钥为商户号前8位，不足8位在商户号前补空格
     */
    public $cardExprDt;





    public static function getParam($model)
    {

        $param = array(
            'out_trade_no' => $model->out_trade_no,
            'mobile_verify_code' => $model->mobile_verify_code,
            'cardCvn2' => $model->cardCvn2,
            'cardExprDt' => $model->cardExprDt,

        );

        return $param;
    }


    public static function getCheckRules()
    {

        $checkRules = array(
            'trusteeshipSignConfirmRequest' => [
                'out_trade_no' => [
                    Validator::MAX_LEN => 32,
                ],
                'mobile_verify_code' => [
                    Validator::MAX_LEN => 6,
                ],
                'cardCvn2' => [
                    Validator::MAX_LEN => 3,
                ],
                'cardExprDt' => [
                    Validator::MAX_LEN => 4,
                ],


            ],

        );

        return $checkRules['trusteeshipSignConfirmRequest'];
    }


}