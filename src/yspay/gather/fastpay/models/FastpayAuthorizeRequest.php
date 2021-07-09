<?php

namespace Yspay\SDK\Model;


use Yspay\SDK\Gathering\Kernel\Validator;

include_once dirname(dirname(dirname(dirname(__FILE__)))) . '\util\Validator.php';


class FastpayAuthorizeRequest
{

    /**
     * 商户生成的订单号
     */
    public $out_trade_no;
    /**
     * 付款方银行绑定手机号码
     */
    public $buyer_mobile;
    /**
     * 验证码
     */
    public $mobile_verify_code;
    /**
     * 贷记卡必填，使用DES加密，密钥为商户号前8位，不足8位在商户号前补空格
     */
    public $cardCvn2;
    /**
     * 贷记卡必填，使用DES加密，密钥为商户号前8位，不足8位在商户号前补空格，格式为MMYY
     */
    public $cardExprDt;







    public static function getParam($model)
    {

        $param = array(
            'out_trade_no' => $model->out_trade_no,
            'buyer_mobile' => $model->buyer_mobile,
            'mobile_verify_code' => $model->mobile_verify_code,
            'cardCvn2' => $model->cardCvn2,
            'cardExprDt' => $model->cardExprDt,

        );

        return $param;
    }


    public static function getCheckRules()
    {

        $checkRules = array(
            'fastpayAuthorizeRequest' => [
                'out_trade_no' => [
                    Validator::MAX_LEN => 32,
                ],
                'buyer_mobile' => [
                    Validator::MAX_LEN => 11,
                ],
                'mobile_verify_code' => [
                    Validator::MAX_LEN => 6,
                ],

            ],

        );

        return $checkRules['fastpayAuthorizeRequest'];
    }


}