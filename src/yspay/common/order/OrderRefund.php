<?php

namespace Yspay\SDK;


use Exception;
use Yspay\SDK\Gathering\Kernel\Common;
use Yspay\SDK\Gathering\Payment\Common\Models\Response;
use Yspay\SDK\Model\BillDownloadurlGetRequest;
use Yspay\SDK\Model\TradeOrderQueryRequest;
use Yspay\SDK\Model\TradeRefundGeneralAccountReq;
use Yspay\SDK\Model\TradeRefundQueryRequest;
use Yspay\SDK\Model\TradeRefundRequest;
use Yspay\SDK\Model\TradeRefundSplitRequest;


include_once dirname(dirname(dirname(__FILE__))) . '\Common.php';


class OrderRefund
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
     * @Desc 普通订单退款（不分账）
     * @DATA 2021年7月01日下午2:02:09
     */
    public function tradeRefund($model)
    {
        try {
            $check = $this->common->checkFields(TradeRefundRequest::getCheckRules()
                , TradeRefundRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = $this->common->commonHeads('ysepay.online.trade.refund', $this->kernel, $model);

            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "shopdate" => $model->shopdate,
                "trade_no" => $model->trade_no,
                "refund_amount" => $model->refund_amount,
                "refund_reason" => $model->refund_reason,
                "out_request_no" => $model->out_request_no,
            );
            $myParams = $this->common->encodeParams($myParams, $bizReqJson);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_trade_refund_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }

    /**
     * lfk
     * @Desc 分账订单退款（用交易金退）
     * @DATA 2021年7月01日下午2:02:09
     */
    public function tradeRefundSplit($model)
    {
        try {
            $check = $this->common->checkFields(TradeRefundSplitRequest::getCheckRules()
                , TradeRefundSplitRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = $this->common->commonHeads('ysepay.online.trade.refund.split', $this->kernel, $model);

            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "shopdate" => $model->shopdate,
                "trade_no" => $model->trade_no,
                "refund_amount" => $model->refund_amount,
                "refund_reason" => $model->refund_reason,
                "out_request_no" => $model->out_request_no,
                "is_division" => $model->is_division,
                "refund_split_info" => $model->refund_split_info,
                "ori_division_mode" => $model->ori_division_mode,
                "order_div_list" => $model->order_div_list,

            );
            $myParams = $this->common->encodeParams($myParams, $bizReqJson);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_trade_refund_split_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 一般消费户退款（用余额退）
     * @DATA 2021年7月01日下午2:02:09
     */
    public function tradeRefundGeneralAccount($model)
    {
        try {
            $check = $this->common->checkFields(TradeRefundGeneralAccountReq::getCheckRules()
                , TradeRefundGeneralAccountReq::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = $this->common->commonHeads('ysepay.online.trade.refund.general.account', $this->kernel, $model);

            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "shopdate" => $model->shopdate,
                "trade_no" => $model->trade_no,
                "refund_amount" => $model->refund_amount,
                "refund_reason" => $model->refund_reason,
                "out_request_no" => $model->out_request_no,
                "is_division" => $model->is_division,
                "refund_split_info" => $model->refund_split_info,

            );
            $myParams = $this->common->encodeParams($myParams, $bizReqJson);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_trade_refund_general_account_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 退款交易查询
     * @DATA 2021年7月08日下午2:02:09
     */
    public function tradeRefundQuery($model)
    {
        try {
            $check = $this->common->checkFields(TradeRefundQueryRequest::getCheckRules()
                , TradeRefundQueryRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = $this->common->commonHeads('ysepay.online.trade.refund.query', $this->kernel, $model);

            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "out_request_no" => $model->out_request_no,
                "trade_no" => $model->trade_no,
            );
            $myParams = $this->common->encodeParams($myParams, $bizReqJson);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_trade_refund_query_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 订单明细查询
     * @DATA 2021年7月08日下午2:02:09
     */
    public function tradeOrderQuery($model)
    {
        try {
            $check = $this->common->checkFields(TradeOrderQueryRequest::getCheckRules()
                , TradeOrderQueryRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = $this->common->commonHeads('ysepay.online.trade.order.query', $this->kernel, $model);

            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "shopdate" => $model->shopdate,
                "trade_no" => $model->trade_no,
            );
            $myParams = $this->common->encodeParams($myParams, $bizReqJson);
            $url = $this->kernel->searchUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_trade_order_query_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 收款交易对账单下载
     * @DATA 2021年7月08日下午2:02:09
     */
    public function billDownloadurlGet($model)
    {
        try {
            $check = $this->common->checkFields(BillDownloadurlGetRequest::getCheckRules()
                , BillDownloadurlGetRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = $this->common->commonHeads('ysepay.online.bill.downloadurl.get', $this->kernel, $model);

            $bizReqJson = array(
                "account_date" => $model->account_date,
            );
            $myParams = $this->common->encodeParams($myParams, $bizReqJson);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_bill_downloadurl_get_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


}