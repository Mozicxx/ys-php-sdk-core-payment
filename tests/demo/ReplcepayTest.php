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
use Yspay\SDK\Model\DfSingleQuickInnerAcceptReq;
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
            $request->out_trade_no = "202107141231231";
            $request->shopdate = "20210714";
            $request->total_amount = "0.01";
            $request->currency = "CNY";
            $request->bank_city = "深圳市";
            $request->bank_province = "广东省";
            $request->business_code = "2010002";
            $request->subject = "单笔代付交易";
            $request->bank_name = "中信银行深圳分行";
            $request->bank_account_name = "刘志林";
            $request->bank_card_type = "debit";
            $request->bank_telephone_no = "18680352162";
            $request->bank_account_type = "personal";
            $request->bank_account_no = "6217710310182456";
            $request->cert_type = "00";
            $request->cert_no = "360781199608035113";
            $request->cert_expire = "20280503";
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
            $request = new DfSingleQuickInnerAcceptReq();
            $request->out_trade_no = "20210708000001";
            $request->shopdate = "20210";
            $request->total_amount = "200001";
            $request->currency = "CNY";
            $request->business_code = "CNY";
            $request->subject = "CNY";
            $request->payee_cust_name = "CNY";
            $request->payee_user_code = "CNY";
            $request->telephone_no = "CNY";
            $request->proxy_password = "CNY";
            $request->merchant_usercode = "CNY";




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
            $request->out_trade_no = "202107080000001";
            $request->shopdate = "20210714";

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