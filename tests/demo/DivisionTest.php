<?php
include_once "../../src/yspay/util/ResponseChecker.php";
include_once "../../src/yspay/common/division/models/DivisionOnlineAcceptRequest.php";
include_once "../../src/yspay/common/division/models/DivisionOnlineQueryRequest.php";
include_once "../../src/yspay/gather/pay/Pay.php";
include_once "Base.php";

use Yspay\Gathering\SDK\Factory;
use Yspay\SDK\Gathering\Base;
use Yspay\SDK\Kernel\Gathering\Util\ResponseChecker;
use Yspay\SDK\Model\DivisionOnlineAcceptRequest;
use Yspay\SDK\Model\DivisionOnlineQueryRequest;


class DivisionTest extends Base
{
    function __construct()
    {
        parent::__construct();

        Base::instance();

    }


    /**
     * lfk
     * @Desc 分账登记
     * @DATA 2021年7月02日下午2:02:09
     */
    public function testDivisionOnlineAccept()
    {

        try {
            $request = new DivisionOnlineAcceptRequest();
            $request->out_trade_no = "20210712123114";
            $request->payee_usercode = "X2107061649551231243";
            $request->total_amount = "0.03";
            $request->sys_flag = "DD";
            $request->is_divistion = "02";
            $request->is_again_division = "N";
            $request->division_mode = "02";
            $request->div_list = " [{'division_mer_usercode': 'hyfz_test2', 'div_amount': 0.01, 'div_ratio': '', 'is_chargeFee': '02'},
             {'division_mer_usercode': 'X2107061649551231243', 'div_amount': 0.02, 'div_ratio': '', 'is_chargeFee': '01'}]";


            $response = Factory::divisionClient()->divisionClass()->divisionOnlineAccept($request);
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
     * @Desc 分账查询
     * @DATA 2021年7月08日下午2:02:09
     */
    public function testDivisionOnlineQuery()
    {

        try {
            $request = new DivisionOnlineQueryRequest();
            $request->out_trade_no = "201805256843192280647118";
            $request->payee_usercode = "2018052568";
            $request->total_amount = "20.00";
            $request->sys_flag = "DD";
            $request->is_divistion = "01";
            $request->is_again_division = "y";
            $request->division_mode = "01";
            $request->div_list = "";
            $request->division_mer_usercode = "201808";

            $response = Factory::divisionClient()->divisionClass()->divisionOnlineQuery($request);
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