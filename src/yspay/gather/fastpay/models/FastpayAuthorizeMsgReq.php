<?php

namespace Yspay\SDK\Model;


use Yspay\SDK\Gathering\Kernel\Validator;

include_once dirname(dirname(dirname(dirname(__FILE__)))) . '\util\Validator.php';


class FastpayAuthorizeMsgReq
{

    /**
     * 商户生成的订单号
     */
    public $out_trade_no;




    public static function getParam($model)
    {

        $param = array(
            'out_trade_no' => $model->out_trade_no,
        );

        return $param;
    }


    public static function getCheckRules()
    {

        $checkRules = array(
            'fastpayAuthorizeMsgReq' => [
                'out_trade_no' => [
                    Validator::MAX_LEN => 32,
                ],
            ],

        );

        return $checkRules['fastpayAuthorizeMsgReq'];
    }


}