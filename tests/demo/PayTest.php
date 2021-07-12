<?php

include_once "../../src/yspay/util/ResponseChecker.php";
include_once "../../src/yspay/gather/pay/models/BarcodepayRequest.php";
include_once "../../src/yspay/gather/pay/models/TradeDeliveredRequest.php";
include_once "../../src/yspay/gather/pay/models/AlijsapiRequest.php";
include_once "../../src/yspay/gather/pay/models/CupgetmulappUseridRequest.php";
include_once "../../src/yspay/gather/pay/models/CupmulappQrcodepayRequest.php";
include_once "../../src/yspay/gather/pay/models/WeixinPayRequest.php";
include_once "../../src/yspay/gather/pay/models/QrcodepayRequest.php";
include_once "../../src/yspay/gather/pay/models/MobileControlsPayRequest.php";
include_once "../../src/yspay/gather/pay/Pay.php";
include_once "Base.php";

use Yspay\Gathering\SDK\Factory;
use Yspay\SDK\Gathering\Base;
use Yspay\SDK\Kernel\Gathering\Util\ResponseChecker;
use Yspay\SDK\Model\AlijsapiRequest;
use Yspay\SDK\Model\BarcodepayRequest;
use Yspay\SDK\Model\CupgetmulappUseridRequest;
use Yspay\SDK\Model\CupmulappQrcodepayRequest;
use Yspay\SDK\Model\MobileControlsPayRequest;
use Yspay\SDK\Model\QrcodepayRequest;
use Yspay\SDK\Model\TradeDeliveredRequest;
use Yspay\SDK\Model\WeixinPayRequest;


class PayTest extends Base
{
    function __construct()
    {
        parent::__construct();

        Base::instance();

    }


    /**
     *反扫码支付
     */
    public function testBarcodepay()
    {

        try {
            $request = new BarcodepayRequest();
            $request->out_trade_no = "2018052568431922806471181";
            $request->shopdate = "20210712";
            $request->subject = "标题";
            $request->total_amount = "0.01";
            $request->seller_id = "hyfz_test";
            $request->seller_name = "银盛支付服务股份有限公司行业发展部";
            $request->timeout_express = "30m";
            $request->business_code = "3010002";
            $request->bank_type = "1902000";
            $request->auth_code = "137163512684555952";
            $response = Factory::payClient()->payClass()->barcodepay($request);
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
     *担保交易发货通知
     */
    public function testTradeDelivered()
    {

        try {
            $request = new TradeDeliveredRequest();
            $request->out_trade_no = "201805256843192280647118";
            $request->shopdate = "20180525";
            $request->trade_no = "";
            $response = Factory::payClient()->payClass()->tradeDelivered($request);
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
     *担保交易确认收货
     */
    public function testTradeConfirm()
    {

        try {
            $request = new TradeDeliveredRequest();
            $request->out_trade_no = "201805256843192280647118";
            $request->shopdate = "20180525";
            $request->trade_no = "";
            $response = Factory::payClient()->payClass()->tradeConfirm($request);
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
     * @Desc 支付宝生活号支付
     * @DATA 2021年7月01日下午2:02:09
     */
    public function testAlijsapi()
    {

        try {
            $request = new AlijsapiRequest();
            $request->out_trade_no = "201805256843192280647118";
            $request->shopdate = "20210707";
            $request->subject = "20180525";
            $request->total_amount = "0.01";
            $request->currency = "20180525";
            $request->seller_id = "20180525";
            $request->seller_name = "20180525";
            $request->timeout_express = "201805";
            $request->extend_params = "20180525";
            $request->extra_common_param = "20180525";
            $request->business_code = "20180525";
            $request->buyer_logon_id = "20180525";
            $request->buyer_id = "20180525";
            $request->consignee_info = "20180525";
            $request->province = "201525";
            $request->city = "201825";
            $request->limit_credit_pay = "20180525";
            $request->hb_fq_num = "20180525";
            $request->allow_repeat_pay = "20180525";
            $request->fail_notify_url = "";
            $response = Factory::payClient()->payClass()->alijsapi($request);
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
     * @Desc 微信公众号、小程序支付
     * @DATA 2021年7月01日下午2:02:09
     */
    public function testWeixinPay()
    {

        try {
            $request = new WeixinPayRequest();
            $request->out_trade_no = "201805256843192280647118";
            $request->shopdate = "20180525";
            $request->subject = "20180525";
            $request->total_amount = "0.01";
            $request->currency = "20180525";
            $request->seller_id = "20180525";
            $request->seller_name = "20180525";
            $request->timeout_express = "2018";
            $request->extend_params = "20180525";
            $request->extra_common_param = "20180525";
            $request->business_code = "20180525";
            $request->sub_openid = "20180525";
            $request->is_minipg = "20180525";
            $request->appid = "20180525";
            $request->province = "20180525";
            $request->city = "20180525";
            $request->mer_amount = "20180525";
            $request->limit_credit_pay = "20180525";
            $request->allow_repeat_pay = "20180525";
            $request->fail_notify_url = "20180525";

            $response = Factory::payClient()->payClass()->weixinPay($request);
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
     * @Desc 行业码获取用户标识
     * @DATA 2021年7月01日下午2:02:09
     */
    public function testCupgetmulappUserid()
    {

        try {
            $request = new CupgetmulappUseridRequest();
            $request->userAuthCode = "201805";
            $request->appUpIdentifier = "UnionPay/1.0ICBCeLife";


            $response = Factory::payClient()->payClass()->cupgetmulappUserid($request);
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
     * @Desc 行业码支付
     * @DATA 2021年7月01日下午2:02:09
     */
    public function testCupmulappQrcodepay()
    {

        try {
            $request = new CupmulappQrcodepayRequest();
            $request->out_trade_no = "201805256843192280647118";
            $request->shopdate = "20210707";
            $request->subject = "201805";
            $request->total_amount = "201805";
            $request->currency = "CNY";
            $request->seller_id = "201805";
            $request->seller_name = "201805";
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
]
}";
            $request->extra_common_param = "201805";
            $request->business_code = "201805";
            $request->spbill_create_ip = "123.12.12.123";
            $request->bank_type = "9001002";
            $request->userId = "201805";
            $request->limit_credit_pay = "0";
            $request->allow_repeat_pay = "0";
            $request->fail_notify_url = "201805";
            $request->consignee_info = "";
            $request->device_info = "";
            $request->terminal_info = "";

            $response = Factory::payClient()->payClass()->cupmulappQrcodepay($request);
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
     * @Desc 正扫支付
     * @DATA 2021年7月01日下午2:02:09
     */
    public function testQrcodepay()
    {

        try {
            $request = new QrcodepayRequest();
            $request->out_trade_no = "201805";
            $request->shopdate = "201805";
            $request->subject = "201805";
            $request->total_amount = "201805";
            $request->currency = "201805";
            $request->seller_id = "201805";
            $request->seller_name = "201805";
            $request->timeout_express = "201805";
            $request->extend_params = "201805";
            $request->extra_common_param = "201805";
            $request->business_code = "201805";
            $request->bank_type = "201805";
            $request->mrchntCertId = "201805";
            $request->consignee_info = "201805";
            $request->cross_border_info = "201805";
            $request->appid = "201805";
            $request->province = "201805";
            $request->city = "201805";
            $request->limit_credit_pay = "201805";
            $request->hb_fq_num = "201805";
            $request->allow_repeat_pay = "201805";
            $request->fail_notify_url = "201805";
            $request->tran_type = "201805";


            $response = Factory::payClient()->payClass()->qrcodepay($request);
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
     * @Desc 手机控件支付
     * @DATA 2021年7月01日下午2:02:09
     */
    public function testMobileControlsPay()
    {

        try {
            $request = new MobileControlsPayRequest();
            $request->out_trade_no = "201805";
            $request->shopdate = "201805";
            $request->subject = "201805";
            $request->total_amount = "201805";
            $request->currency = "201805";
            $request->seller_id = "201805";
            $request->seller_name = "201805";
            $request->timeout_express = "96h";
            $request->extend_params = "201805";
            $request->extra_common_param = "201805";
            $request->business_code = "201805";
            $request->bank_type = "9001002";
            $request->bank_account_type = "2";
            $request->support_card_type = "2";
            $request->cross_border_info = "";
            $request->consignee_info = "";


            $response = Factory::payClient()->payClass()->mobileControlsPay($request);
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
