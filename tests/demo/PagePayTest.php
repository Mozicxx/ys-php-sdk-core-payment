<?php
include_once "../../src/yspay/util/ResponseChecker.php";
include_once "../../src/yspay/gather/pagepay/models/WapDirectpayCreatebyuserReq.php";
include_once "../../src/yspay/gather/pagepay/models/DirectpayCreatebyuserRequest.php";
include_once "Base.php";

use Yspay\Gathering\SDK\Factory;
use Yspay\SDK\Gathering\Base;
use Yspay\SDK\Kernel\Gathering\Util\ResponseChecker;
use Yspay\SDK\Model\DirectpayCreatebyuserRequest;
use Yspay\SDK\Model\WapDirectpayCreatebyuserReq;


class PagePayTest extends Base
{
    function __construct()
    {
        parent::__construct();

        Base::instance();

    }


    /**
     * lfk
     * @Desc WAP页面支付
     * @DATA 2021年7月02日下午2:02:09
     */
    public function testBarcodepay()
    {

        try {
            $request = new WapDirectpayCreatebyuserReq();
            $request->out_trade_no = "20210256843192280647118";
            $request->shopdate = "20210707";
            $request->subject = "2280647118";
            $request->total_amount = "98h";
            $request->currency = "CYN";
            $request->seller_id = "201805118";
            $request->seller_name = "2018647118";
            $request->timeout_express = "";
            $request->extend_params = "20180520647118";
            $request->extra_common_param = "20180527118";
            $request->business_code = "20187118";
            $request->pay_mode = "2018192280647118";
            $request->bank_type = "20182280647118";
            $request->bank_account_type = "1";
            $request->support_card_type = "2";
            $request->mer_outside_custid = "2317118";
            $request->bank_account_no = "202280647118";
            $request->fast_pay_name = "20180280647118";
            $request->fast_pay_id_no = "201892280647118";
            $request->fast_pay_validity = "2010647118";
            $request->fast_pay_mobile = "280647118";
            $request->fast_pay_cvv2 = "20180647118";
            $request->consignee_info = "";
            $request->cross_border_info = "";
            $request->appid = "20187118";
            $request->province = "20180647118";
            $request->city = "20147118";
            $request->return_url = "https://www.baidu.com/";

            $response = Factory::pagePayClient()->pagePayClass()->wapDirectpayCreatebyuser($request);
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
     * @Desc WEB页面支付
     * @DATA 2021年7月02日下午2:02:09
     */
    public function testDirectpayCreatebyuser()
    {

        try {
            $request = new DirectpayCreatebyuserRequest();
            $request->out_trade_no = "20210707";
            $request->shopdate = "20210707";
            $request->subject = "20210707";
            $request->total_amount = "20210707";
            $request->timeout_express = "98h";
            $request->currency = "CNY";
            $request->seller_id = "20210707";
            $request->seller_name = "20210707";
            $request->extend_params = "20210707";
            $request->extra_common_param = "20210707";
            $request->business_code = "20210707";
            $request->pay_mode = "20210707";
            $request->bank_type = "20210";
            $request->bank_account_type = "2";
            $request->support_card_type = "1";
            $request->bank_account_no = "20210707";
            $request->consignee_info = "";
            $request->cross_border_info = "";
            $request->return_url = "https://www.baidu.com/";


            $response = Factory::pagePayClient()->pagePayClass()->directpayCreatebyuser($request);
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