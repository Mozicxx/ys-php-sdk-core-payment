<?php
include_once "../../src/yspay/util/ResponseChecker.php";
include_once "../../src/yspay/replace/replcepay/models/DfBillDownloadurlGetRequest.php";
include_once "../../src/yspay/replace/replcepay/models/DSingleQuickQueryRequest.php";
include_once "../../src/yspay/replace/replcepay/models/DfSingleQuickAcceptRequest.php";
include_once "../../src/yspay/replace/replcepay/models/DfSingleQuickInnerAcceptReq.php";

include_once "../../src/yspay/gather/pay/Pay.php";
include_once "Base.php";

use Yspay\Gathering\SDK\Factory;
use Yspay\SDK\Gathering\Base;
use Yspay\SDK\Kernel\Gathering\Util\ResponseChecker;
use Yspay\SDK\Model\DfBillDownloadurlGetRequest;
use Yspay\SDK\Model\DfSingleQuickAcceptRequest;
use Yspay\SDK\Model\DSingleQuickQueryRequest;


class ReplcepayTest extends Base
{
    function __construct()
    {
        parent::__construct();

        Base::instance();

    }


    /**
     * lfk
     * @Desc 单笔代付对账单
     * @DATA 2021年7月08日下午2:02:09
     */
    public function testDfBillDownloadurlGet()
    {

        try {
            $request = new DfBillDownloadurlGetRequest();
            $request->account_date = "2018-04-13";
            $request->proxy_password = "";
            $request->merchant_usercode = "";

            $response = Factory::replcePayClient()->replcePayClass()->dfBillDownloadurlGet($request);
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
     * @Desc 单笔代付交易（银行卡）
     * @DATA 2021年7月08日下午2:02:09
     */
    public function testDfSingleQuickAccept()
    {

        try {
            $request = new DfSingleQuickAcceptRequest();
            $request->out_trade_no = "20210708000001";
            $request->shopdate = "20210708";
            $request->total_amount = "0.01";
            $request->currency = "CNY";
            $request->bank_city = "深圳市";
            $request->bank_province = "广东省";
            $request->business_code = "20170828000001";
            $request->subject = "20170828000001";
            $request->bank_name = "中国银行深圳民治支行";
            $request->bank_account_name = "20170828000001";
            $request->bank_card_type = "debit";
            $request->bank_telephone_no = "1000000000000000000";
            $request->bank_account_type = "corporate";
            $request->bank_account_no = "1000000000000000000";
            $request->cert_type = "20170828000001";
            $request->cert_no = "20170828000001";
            $request->cert_expire = "20170828000001";
            $request->consignee_info = "";
            $request->proxy_password = "";
            $request->merchant_usercode = "";

            $response = Factory::replcePayClient()->replcePayClass()->dfSingleQuickAccept($request);
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
     * @Desc 单笔代付交易（平台内）
     * @DATA 2021年7月08日下午2:02:09
     */
    public function testDfSingleQuickInnerAccept()
    {

        try {
            $request = new DfSingleQuickAcceptRequest();
            $request->out_trade_no = "20210708000001";
            $request->shopdate = "20210";
            $request->total_amount = "200001";
            $request->currency = "CNY";
            $request->bank_city = "20001";
            $request->bank_province = "20000001";
            $request->business_code = "202100001";
            $request->subject = "20201";
            $request->bank_name = "20200001";
            $request->bank_account_name = "200001";
            $request->bank_card_type = "21";
            $request->bank_telephone_no = "20200001";
            $request->bank_account_type = "21";
            $request->bank_account_no = "202001";
            $request->cert_type = "2001";
            $request->cert_no = "2020001";
            $request->cert_expire = "202001";
            $request->consignee_info = "";
            $request->proxy_password = "";
            $request->merchant_usercode = "";


            $response = Factory::replcePayClient()->replcePayClass()->dfSingleQuickInnerAccept($request);
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
     * @Desc 单笔代付查询
     * @DATA 2021年7月08日下午2:02:09
     */
    public function testDfSingleQuickQuery()
    {

        try {
            $request = new DSingleQuickQueryRequest();
            $request->out_trade_no = "20210708000001";
            $request->shopdate = "20210";



            $response = Factory::replcePayClient()->replcePayClass()->dfSingleQuickQuery($request);
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