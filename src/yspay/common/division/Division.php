<?php

namespace Yspay\SDK;


use Exception;
use Yspay\SDK\Gathering\Kernel\Common;
use Yspay\SDK\Gathering\Payment\Common\Models\Response;
use Yspay\SDK\Model\DivisionOnlineAcceptRequest;
use Yspay\SDK\Model\DivisionOnlineQueryRequest;


include_once dirname(dirname(dirname(__FILE__))) . '\Common.php';


class Division
{


    public $common;
    protected $kernel;

    public function __construct($kernel)
    {
        $this->common = new Common($kernel);
        $this->kernel = $kernel;
    }


    /**
     * lfk
     * @Desc 分账登记
     * @DATA 2021年7月08日下午2:02:09
     */
    public function divisionOnlineAccept($model)
    {
        try {
            $check = $this->common->checkFields(DivisionOnlineAcceptRequest::getCheckRules()
                , DivisionOnlineAcceptRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.single.division.online.accept';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charsetGBK;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "payee_usercode" => $model->payee_usercode,
                "total_amount" => $model->total_amount,
                "sys_flag" => $model->sys_flag,
                "is_divistion" => $model->is_divistion,
                "is_again_division" => $model->is_again_division,
                "division_mode" => $model->division_mode,
                "div_list" => $model->div_list,
                "division_mer_usercode" => $model->division_mer_usercode,
            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->commonUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_single_division_online_accept_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }



    /**
     * lfk
     * @Desc 分账查询
     * @DATA 2021年7月08日下午2:02:09
     */
    public function divisionOnlineQuery($model)
    {
        try {
            $check = $this->common->checkFields(DivisionOnlineQueryRequest::getCheckRules()
                , DivisionOnlineQueryRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.single.division.online.query';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charsetGBK;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $bizReqJson = array(
                "src_usercode" => $model->src_usercode,
                "out_trade_no" => $model->out_trade_no,
                "out_batch_no" => $model->out_batch_no,
                "sys_flag" => $model->sys_flag,

            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->commonUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_trade_delivered_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


}