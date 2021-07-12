<?php
include_once "../../src/yspay/util/ResponseChecker.php";
include_once "../../src/yspay/common/merchant/models/MerchantBalanceQueryRequest.php";
include_once "../../src/yspay/common/merchant/models/MerchantWithdrawQueryRequest.php";
include_once "../../src/yspay/common/merchant/models/MerchantWithdrawRequest.php";
include_once "../../src/yspay/gather/pay/Pay.php";
include_once "Base.php";

use Yspay\Gathering\SDK\Factory;
use Yspay\SDK\Gathering\Base;
use Yspay\SDK\Kernel\Gathering\Util\ResponseChecker;
use Yspay\SDK\Model\DivisionOnlineAcceptRequest;
use Yspay\SDK\Model\MerchantBalanceQueryRequest;
use Yspay\SDK\Model\MerchantWithdrawRequest;


class MerchantTest extends Base
{
    function __construct()
    {
        parent::__construct();

        Base::instance();

    }


    /**
     * lfk
     * @Desc 一般消费户提现
     * @DATA 2021年7月02日下午2:02:09
     */
    public function testDivisionOnlineAccept()
    {

        try {
            $request = new MerchantWithdrawRequest();
            $request->out_trade_no = "20180525684318";
            $request->shopdate = "20180525";
            $request->currency = "CNY";
            $request->merchant_usercode = "";
            $request->total_amount = "20.01";
            $request->subject = "20180525684319228";
            $request->bank_account_no = "1000000000000000000";


            $response = Factory::merchantClient()->merchantClass()->merchantWithdraw($request);
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
     * @Desc 待结算账户提现 （D0提现）
     * @DATA 2021年7月01日下午2:02:09
     */
    public function testMerchantWithdrawD0()
    {

        try {
            $request = new MerchantWithdrawRequest();
            $request->out_trade_no = "20180525684318";
            $request->shopdate = "20180525";
            $request->currency = "CNY";
            $request->merchant_usercode = "";
            $request->total_amount = "20.01";
            $request->subject = "20180525684319228";
            $request->bank_account_no = "1000000000000000000";


            $response = Factory::merchantClient()->merchantClass()->merchantWithdrawD0($request);
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
     * @Desc 商户提现查询
     * @DATA 2021年7月12日下午2:02:09
     */
    public function testMerchantWithdrawQuery()
    {

        try {
            $request = new MerchantWithdrawRequest();
            $request->out_trade_no = "20180525684318";
            $request->shopdate = "20180525";


            $response = Factory::merchantClient()->merchantClass()->merchantWithdrawQuery($request);
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
     * @Desc 商户余额查询
     * @DATA 2021年7月08日下午2:02:09
     */
    public function testMerchantBalanceQuery()
    {

        try {
            $request = new MerchantBalanceQueryRequest();
            $request->merchant_usercode = "20180525684318";


            $response = Factory::merchantClient()->merchantClass()->merchantBalanceQuery($request);
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