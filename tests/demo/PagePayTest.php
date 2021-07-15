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
    public function testWapDirectpayCreatebyuser()
    {

        try {
            $request = new WapDirectpayCreatebyuserReq();
            $request->out_trade_no = "202107141231";
            $request->shopdate = "20210714";
            $request->subject = "WAP页面支付";
            $request->total_amount = "0.02";
            $request->seller_id = "hyfz_test";
            $request->seller_name = "银盛支付服务股份有限公司行业发展部";
            $request->timeout_express = "30m";
            $request->extra_common_param = "";
            $request->business_code = "3010002";
            $request->pay_mode = "internetbank";
            $request->bank_type = "1902000";
            $request->bank_account_type = "personal";
            $request->support_card_type = "debit";
            $request->bank_account_no = "";
            $request->fast_pay_name = "";
            $request->fast_pay_id_no = "";
            $request->fast_pay_validity = "";
            $request->fast_pay_mobile = "";
            $request->fast_pay_cvv2 = "";
            $request->return_url = "https://www.baidu.com/";
            $request->tran_type = "2";

            $response = Factory::pagePayClient()->pagePayClass()->wapDirectpayCreatebyuser($request);
            $txt = $response->response;
            $myfile = fopen("./pagepay/WapPayTest.html", "w") or die("Unable to open file!");
            fwrite($myfile, $txt);
            fclose($myfile);
            var_dump($response, true);
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
            $request->out_trade_no = "2021071412311";
            $request->shopdate = "20210714";
            $request->subject = "WEB页面支付";
            $request->total_amount = "0.02";
            $request->timeout_express = "30m";
            $request->currency = "CNY";
            $request->seller_id = "hyfz_test";
            $request->seller_name = "银盛支付服务股份有限公司行业发展部";
            $request->extend_params = "";
            $request->extra_common_param = "";
            $request->business_code = "3010002";
            $request->pay_mode = "internetbank";
            $request->bank_type = "3021000";
            $request->bank_account_type = "personal";
            $request->support_card_type = "debit";
            $request->consignee_info = "";
            $request->cross_border_info = "";
            $request->return_url = "https://www.baidu.com/";
            $request->tran_type = "2";

            $response = Factory::pagePayClient()->pagePayClass()->directpayCreatebyuser($request);
            $txt = $response->response;
            $myfile = fopen("./pagepay/WebPayTest.html", "w") or die("Unable to open file!");
            fwrite($myfile, $txt);
            fclose($myfile);
            var_dump($response, true);

        } catch (Exception $e) {
            echo "调用失败，" . $e->getMessage() . PHP_EOL;;
        }

    }


}