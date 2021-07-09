<?php
include_once "../../src/yspay/util/ResponseChecker.php";
include_once "../../src/yspay/gather/fastpay/models/FastpayAuthorizeMsgReq.php";
include_once "../../src/yspay/gather/fastpay/models/FastpayAuthorizeRequest.php";
include_once "../../src/yspay/gather/fastpay/models/FastpayRequest.php";
include_once "../../src/yspay/gather/fastpay/models/TrusteeshipfastPayRequest.php";
include_once "../../src/yspay/gather/fastpay/models/TrusteeshipSignConfirmRequest.php";
include_once "../../src/yspay/gather/fastpay/models/TrusteeshipSignRequest.php";

include_once "../../src/yspay/gather/pay/Pay.php";
include_once "Base.php";

use Yspay\Gathering\SDK\Factory;
use Yspay\SDK\Gathering\Base;
use Yspay\SDK\Kernel\Gathering\Util\ResponseChecker;
use Yspay\SDK\Model\BarcodepayRequest;
use Yspay\SDK\Model\FastpayAuthorizeMsgReq;
use Yspay\SDK\Model\FastpayAuthorizeRequest;
use Yspay\SDK\Model\FastpayRequest;
use Yspay\SDK\Model\TrusteeshipfastPayRequest;
use Yspay\SDK\Model\TrusteeshipSignConfirmRequest;
use Yspay\SDK\Model\TrusteeshipSignRequest;


class FastpayTest extends Base
{
    function __construct()
    {
        parent::__construct();

        Base::instance();

    }


    /**
     * lfk
     * @Desc 快捷消费申请
     * @DATA 2021年7月02日下午2:02:09
     */
    public function testBarcodepay()
    {

        try {
            $request = new FastpayRequest();
            $request->out_trade_no = "201805256843192280647118";
            $request->shopdate = "20180525";
            $request->subject = "20180525118";
            $request->total_amount = "0.01";
            $request->currency = "CNY";
            $request->seller_id = "2018052";
            $request->seller_name = "201805218";
            $request->timeout_express = "9H";
            $request->extend_params = "20180518";
            $request->extra_common_param = "201808";
            $request->business_code = "201805256";
            $request->buyer_name = "2018052568438";
            $request->buyer_card_number = "2018052568418";
            $request->buyer_mobile = "201856818";
            $request->bank_type = "84318";
            $request->bank_account_type = "2";
            $request->support_card_type = "2";
            $request->bank_name = "201805256843";
            $request->cardCvn2 = "20180528";
            $request->cardExprDt = "201805";
            $request->pyerIDTp = "";
            $request->pyerIDNo = "";
            $request->consignee_info = "";
            $request->cross_border_info = "";
            $request->appid = "2018052";
            $request->province = "2018052";
            $request->city = "201805258";
            $request->limit_credit_pay = "2010647118";
            $request->mccs = "201807118";
            $request->mer_no = "20187118";

            $response = Factory::fastpayClient()->fastpayClass()->fastpay($request);
            var_dump($response, true);
            $responseChecker = new ResponseChecker();
            // 处理响应或异常
            if ($responseChecker->success($response)) {
                echo "调用成功" . PHP_EOL;
            } else {
                echo "调用失败,原因：" . $response->response['msg'];
            }
        } catch (Exception $e) {
            echo "调用失败，" . $e->getMessage() . PHP_EOL;;
        }

    }


    /**
     * lfk
     * @Desc 快捷消费授权
     * @DATA 2021年7月02日下午2:02:09
     */
    public function testfastpayAuthorize()
    {

        try {
            $request = new FastpayAuthorizeRequest();
            $request->out_trade_no = "6843192280647118";
            $request->buyer_mobile = "20180525";
            $request->mobile_verify_code = "2018";
            $request->cardCvn2 = "20180525";
            $request->cardExprDt = "20180525";


            $response = Factory::fastpayClient()->fastpayClass()->fastpayAuthorize($request);
            var_dump($response, true);
            $responseChecker = new ResponseChecker();
            // 处理响应或异常
            if ($responseChecker->success($response)) {
                echo "调用成功" . PHP_EOL;
            } else {
                echo "调用失败,原因：" . $response->response['msg'];
            }
        } catch (Exception $e) {
            echo "调用失败，" . $e->getMessage() . PHP_EOL;;
        }

    }


    /**
     * lfk
     * @Desc 快捷重新获取授权码
     * @DATA 2021年7月02日下午2:02:09
     */
    public function testFastpayAuthorizeMsg()
    {

        try {
            $request = new FastpayAuthorizeMsgReq();
            $request->out_trade_no = "6843192280647118";


            $response = Factory::fastpayClient()->fastpayClass()->fastpayAuthorizeMsg($request);
            var_dump($response, true);
            $responseChecker = new ResponseChecker();
            // 处理响应或异常
            if ($responseChecker->success($response)) {
                echo "调用成功" . PHP_EOL;
            } else {
                echo "调用失败,原因：" . $response->response['msg'];
            }
        } catch (Exception $e) {
            echo "调用失败，" . $e->getMessage() . PHP_EOL;;
        }

    }


    /**
     * lfk
     * @Desc 发起签约申请
     * @DATA 2021年7月07日下午2:02:09
     */
    public function testTrusteeshipSign()
    {

        try {
            $request = new TrusteeshipSignRequest();
            $request->out_trade_no = "6843192280647118";
            $request->seller_id = "6843192280647118";
            $request->seller_name = "6843192280647118";
            $request->total_amount = "6843192280647118";
            $request->buyer_name = "6843192280647118";
            $request->buyer_card_number = "68447118";
            $request->buyer_mobile = "684118";
            $request->cardCvn2 = "684317118";
            $request->cardExprDt = "680647118";
            $request->pyerIDNo = "682280647118";
            $request->imei = "6843647118";
            $request->actionScope = "68280647118";
            $request->user_id = "6843197118";

            $response = Factory::fastpayClient()->fastpayClass()->trusteeshipSign($request);
            var_dump($response, true);
            $responseChecker = new ResponseChecker();
            // 处理响应或异常
            if ($responseChecker->success($response)) {
                echo "调用成功" . PHP_EOL;
            } else {
                echo "调用失败,原因：" . $response->response['msg'];
            }
        } catch (Exception $e) {
            echo "调用失败，" . $e->getMessage() . PHP_EOL;;
        }

    }



    /**
     * lfk
     * @Desc 签约确认接口
     * @DATA 2021年7月07日下午2:02:09
     */
    public function testTrusteeshipSignConfirm()
    {

        try {
            $request = new TrusteeshipSignConfirmRequest();
            $request->out_trade_no = "201805256843192280647118";
            $request->mobile_verify_code = "101098";
            $request->cardCvn2 = "";
            $request->cardExprDt = "";


            $response = Factory::fastpayClient()->fastpayClass()->trusteeshipSignConfirm($request);
            var_dump($response, true);
            $responseChecker = new ResponseChecker();
            // 处理响应或异常
            if ($responseChecker->success($response)) {
                echo "调用成功" . PHP_EOL;
            } else {
                echo "调用失败,原因：" . $response->response['msg'];
            }
        } catch (Exception $e) {
            echo "调用失败，" . $e->getMessage() . PHP_EOL;;
        }

    }


    /**
     * lfk
     * @Desc 快捷协议支付
     * @DATA 2021年7月07日下午2:02:09
     */
    public function testTrusteeshipfastPay()
    {

        try {
            $request = new TrusteeshipfastPayRequest();
            $request->out_trade_no = "201805256843192280647118";
            $request->shopdate = "20210707";
            $request->subject = "2018052";
            $request->total_amount = "0.01";
            $request->currency = "CNY";
            $request->seller_id = "2018052";
            $request->seller_name = "2018052";
            $request->timeout_express = "96h";
            $request->extend_params = "{
\"cartTYpe\": \"00\",
\"order_mode\": \"01\",
\"seller_list\": [{
\"seller_id\": \"123\"
},
{
\"seller_id\": \"456\"
}
]";
            $request->extra_common_param = "2018052";
            $request->business_code = "2018052";
            $request->protocol_no = "2018052";
            $request->cardCvn2 = "2018052";
            $request->cardExprDt = "2018052";
            $request->consignee_info = "";
            $request->user_id = "2018052";
            $request->province = "2018052";
            $request->city = "2018052";
            $request->mccs = "5811";
            $request->mer_no = "2018052";


            $response = Factory::fastpayClient()->fastpayClass()->trusteeshipfastPay($request);
            var_dump($response, true);
            $responseChecker = new ResponseChecker();
            // 处理响应或异常
            if ($responseChecker->success($response)) {
                echo "调用成功" . PHP_EOL;
            } else {
                echo "调用失败,原因：" . $response->response['msg'];
            }
        } catch (Exception $e) {
            echo "调用失败，" . $e->getMessage() . PHP_EOL;;
        }

    }

}