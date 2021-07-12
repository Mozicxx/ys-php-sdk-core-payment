<?php
include_once "../../src/yspay/util/ResponseChecker.php";
include_once "../../src/yspay/common/order/models/BillDownloadurlGetRequest.php";
include_once "../../src/yspay/common/order/models/TradeRefundRequest.php";
include_once "../../src/yspay/common/order/models/TradeOrderQueryRequest.php";
include_once "../../src/yspay/common/order/models/TradeRefundGeneralAccountReq.php";
include_once "../../src/yspay/common/order/models/TradeRefundQueryRequest.php";
include_once "../../src/yspay/common/order/models/TradeRefundSplitRequest.php";
include_once "../../src/yspay/gather/pay/Pay.php";
include_once "Base.php";

use Yspay\Gathering\SDK\Factory;
use Yspay\SDK\Gathering\Base;
use Yspay\SDK\Kernel\Gathering\Util\ResponseChecker;
use Yspay\SDK\Model\BillDownloadurlGetRequest;
use Yspay\SDK\Model\TradeOrderQueryRequest;
use Yspay\SDK\Model\TradeRefundGeneralAccountReq;
use Yspay\SDK\Model\TradeRefundQueryRequest;
use Yspay\SDK\Model\TradeRefundRequest;
use Yspay\SDK\Model\TradeRefundSplitRequest;


class OrderTest extends Base
{
    function __construct()
    {
        parent::__construct();

        Base::instance();

    }


    /**
     * lfk
     * @Desc 普通订单退款（不分账）
     * @DATA 2021年7月01日下午2:02:09
     */
    public function testTradeRefund()
    {

        try {
            $request = new TradeRefundRequest();
            $request->out_trade_no = "20180525684318";
            $request->shopdate = "20180522";
            $request->trade_no = "20180525684318";
            $request->refund_amount = "0.01";
            $request->refund_reason = "20180525684318";
            $request->out_request_no = "20180525684318";


            $response = Factory::orderRefundClient()->orderRefundClass()->tradeRefund($request);
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
     * @Desc 分账订单退款（用交易金退）
     * @DATA 2021年7月01日下午2:02:09
     */
    public function testTradeRefundSplit()
    {

        try {
            $request = new TradeRefundSplitRequest();
            $request->out_trade_no = "20180525684318";
            $request->shopdate = "20180525";
            $request->trade_no = "20180525684318";
            $request->refund_amount = "20.0";
            $request->refund_reason = "20180525684318";
            $request->out_request_no = "20180525684318";
            $request->is_division = "1";
            $request->refund_split_info = "";
            $request->ori_division_mode = "20180525684318";
            $request->order_div_list = "";


            $response = Factory::orderRefundClient()->orderRefundClass()->tradeRefundSplit($request);
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
     * @Desc 一般消费户退款（用余额退）
     * @DATA 2021年7月12日下午2:02:09
     */
    public function testTradeRefundGeneralAccount()
    {

        try {
            $request = new TradeRefundGeneralAccountReq();
            $request->out_trade_no = "20180525684318";
            $request->shopdate = "20180525";
            $request->trade_no = "20180525684318";
            $request->refund_amount = "0.01";
            $request->refund_reason = "20180525684318";
            $request->out_request_no = "20180525684318";
            $request->is_division = "1";
            $request->refund_split_info = "";


            $response = Factory::orderRefundClient()->orderRefundClass()->tradeRefundGeneralAccount($request);
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
     * @Desc 退款交易查询
     * @DATA 2021年7月08日下午2:02:09
     */
    public function testTradeRefundQuery()
    {

        try {
            $request = new TradeRefundQueryRequest();
            $request->out_trade_no = "20180525684318";
            $request->out_request_no = "20180525684318";
            $request->trade_no = "20180525684318";


            $response = Factory::orderRefundClient()->orderRefundClass()->tradeRefundQuery($request);
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
     * @Desc 订单明细查询
     * @DATA 2021年7月08日下午2:02:09
     */
    public function testTradeOrderQuery()
    {

        try {
            $request = new TradeOrderQueryRequest();
            $request->out_trade_no = "20180525684318";
            $request->shopdate = "20180525";
            $request->trade_no = "20180525684318";


            $response = Factory::orderRefundClient()->orderRefundClass()->tradeOrderQuery($request);
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
     * @Desc 收款交易对账单下载
     * @DATA 2021年7月08日下午2:02:09
     */
    public function testBillDownloadurlGet()
    {

        try {
            $request = new BillDownloadurlGetRequest();
            $request->account_date = "2018-05-25";


            $response = Factory::orderRefundClient()->orderRefundClass()->billDownloadurlGet($request);
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