<?php

namespace Yspay\SDK;


use Exception;
use Yspay\SDK\Gathering\Kernel\Common;
use Yspay\SDK\Gathering\Payment\Common\Models\Response;
use Yspay\SDK\Model\MerchantBalanceQueryRequest;
use Yspay\SDK\Model\MerchantWithdrawQueryRequest;
use Yspay\SDK\Model\MerchantWithdrawRequest;


include_once dirname(dirname(dirname(__FILE__))) . '\Common.php';


class Merchant
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
     * @Desc 一般消费户提现
     * @DATA 2021年7月01日下午2:02:09
     */
    public function merchantWithdraw($model)
    {
        try {
            $check = $this->common->checkFields(MerchantWithdrawRequest::getCheckRules()
                , MerchantWithdrawRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.merchant.withdraw.quick.accept';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "shopdate" => $model->shopdate,
                "currency" => $model->currency,
                "merchant_usercode" => $model->merchant_usercode,
                "total_amount" => $model->total_amount,
                "subject" => $model->subject,
                "bank_account_no" => $model->bank_account_no,
            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->commonUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_merchant_withdraw_quick_accept_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }



    /**
     * lfk
     * @Desc 待结算账户提现 （D0提现）
     * @DATA 2021年7月01日下午2:02:09
     */
    public function merchantWithdrawD0($model)
    {
        try {
            $check = $this->common->checkFields(MerchantWithdrawRequest::getCheckRules()
                , MerchantWithdrawRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.merchant.withdraw.d0.accept';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "shopdate" => $model->shopdate,
                "currency" => $model->currency,
                "merchant_usercode" => $model->merchant_usercode,
                "total_amount" => $model->total_amount,
                "subject" => $model->subject,
                "bank_account_no" => $model->bank_account_no,
            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->commonUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_merchant_withdraw_d0_accept_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 商户提现查询
     * @DATA 2021年7月01日下午2:02:09
     */
    public function merchantWithdrawQuery($model)
    {
        try {
            $check = $this->common->checkFields(MerchantWithdrawQueryRequest::getCheckRules()
                , MerchantWithdrawQueryRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.merchant.withdraw.quick.query';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "shopdate" => $model->shopdate,
            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->commonUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_merchant_withdraw_quick_query_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 商户余额查询
     * @DATA 2021年7月08日下午2:02:09
     */
    public function merchantBalanceQuery($model)
    {
        try {
            $check = $this->common->checkFields(MerchantBalanceQueryRequest::getCheckRules()
                , MerchantBalanceQueryRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.merchant.balance.query';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $bizReqJson = array(
                "merchant_usercode" => $model->merchant_usercode,
            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->commonUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_merchant_balance_query_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


}