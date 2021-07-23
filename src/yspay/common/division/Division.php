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
            
            $myParams = $this->common->commonHeads('ysepay.single.division.online.accept', $this->kernel, $model);
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
            $myParams = $this->common->encodeParams($myParams,$bizReqJson);
            $url = $this->kernel->commonUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, 'ysepay_single_division_online_accept_response', false);
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
            
            $myParams = $this->common->commonHeads('ysepay.single.division.online.query', $this->kernel, $model);
            $bizReqJson = array(
                "src_usercode" => $model->src_usercode,
                "out_trade_no" => $model->out_trade_no,
                "out_batch_no" => $model->out_batch_no,
                "sys_flag" => $model->sys_flag,

            );
            $myParams = $this->common->encodeParams($myParams,$bizReqJson);
            $url = $this->kernel->commonUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_single_division_online_query_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


}