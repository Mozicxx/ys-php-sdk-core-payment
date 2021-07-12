<?php

namespace Yspay\SDK;


use Exception;
use Yspay\SDK\Gathering\Kernel\Common;
use Yspay\SDK\Gathering\Payment\Common\Models\Response;
use Yspay\SDK\Model\FastpayAuthorizeMsgReq;
use Yspay\SDK\Model\FastpayAuthorizeRequest;
use Yspay\SDK\Model\FastpayRequest;
use Yspay\SDK\Model\TrusteeshipfastPayRequest;
use Yspay\SDK\Model\TrusteeshipSignConfirmRequest;
use Yspay\SDK\Model\TrusteeshipSignRequest;


include_once dirname(dirname(dirname(__FILE__))) . '\Common.php';


class Fastpay
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
     * @Desc 快捷消费申请
     * @DATA 2021年7月02日下午2:02:09
     */
    public function fastpay($model)
    {
        try {
            $check = $this->common->checkFields(FastpayRequest::getCheckRules()
                , FastpayRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.online.fastpay';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $myParams['tran_type'] = $model->tran_type;
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "shopdate" => $model->shopdate,
                "subject" => $model->subject,
                "total_amount" => $model->total_amount,
                "currency" => $model->currency,
                "seller_id" => $model->seller_id,
                "seller_name" => $model->seller_name,
                "timeout_express" => $model->timeout_express,
                "extend_params" => $model->extend_params,
                "extra_common_param" => $model->extra_common_param,
                "business_code" => $model->business_code,
                "buyer_name" => $model->buyer_name,
                "buyer_card_number" => $model->buyer_card_number,
                "buyer_mobile" => $model->buyer_mobile,
                "bank_type" => $model->bank_type,
                "bank_account_type" => $model->bank_account_type,
                "support_card_type" => $model->support_card_type,
                "bank_name" => $model->bank_name,
                "cardCvn2" => $model->cardCvn2,
                "cardExprDt" => $model->cardExprDt,
                "pyerIDTp" => $model->pyerIDTp,
                "pyerIDNo" => $model->pyerIDNo,
                "consignee_info" => $model->consignee_info,
                "cross_border_info" => $model->cross_border_info,
                "province" => $model->province,
                "city" => $model->city,
                "limit_credit_pay" => $model->limit_credit_pay,
                "mccs" => $model->mccs,
                "mer_no" => $model->mer_no,


            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_fastpay_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 快捷消费授权
     * @DATA 2021年7月02日下午2:02:09
     */
    public function fastpayAuthorize($model)
    {
        try {
            $check = $this->common->checkFields(FastpayAuthorizeRequest::getCheckRules()
                , FastpayAuthorizeRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.online.fastpay.authorize';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $myParams['tran_type'] = $model->tran_type;
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "buyer_mobile" => $model->buyer_mobile,
                "mobile_verify_code" => $model->mobile_verify_code,

            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_fastpay_authorize_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }

    /**
     * lfk
     * @Desc 快捷重新获取授权码
     * @DATA 2021年7月02日下午2:02:09
     */
    public function fastpayAuthorizeMsg($model)
    {
        try {
            $check = $this->common->checkFields(FastpayAuthorizeMsgReq::getCheckRules()
                , FastpayAuthorizeMsgReq::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.online.fastpay.authorize.msg';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $myParams['tran_type'] = $model->tran_type;
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,

            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_fastpay_authorize_msg_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }

    /**
     * lfk
     * @Desc 发起签约申请
     * @DATA 2021年7月02日下午2:02:09
     */
    public function trusteeshipSign($model)
    {
        try {
            $check = $this->common->checkFields(TrusteeshipSignRequest::getCheckRules()
                , TrusteeshipSignRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.trusteeship.sign';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $myParams['tran_type'] = $model->tran_type;
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "seller_id" => $model->seller_id,
                "seller_name" => $model->seller_name,
                "total_amount" => $model->total_amount,
                "buyer_name" => $model->buyer_name,
                "buyer_card_number" => $model->buyer_card_number,
                "buyer_mobile" => $model->buyer_mobile,
                "cardCvn2" => $model->cardCvn2,
                "cardExprDt" => $model->cardExprDt,
                "pyerIDNo" => $model->pyerIDNo,
                "imei" => $model->imei,
                "actionScope" => $model->actionScope,
                "user_id" => $model->user_id,

            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_trusteeship_sign_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 签约确认接口
     * @DATA 2021年7月02日下午2:02:09
     */
    public function trusteeshipSignConfirm($model)
    {
        try {
            $check = $this->common->checkFields(TrusteeshipSignConfirmRequest::getCheckRules()
                , TrusteeshipSignConfirmRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.trusteeship.sign.confirm';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $myParams['tran_type'] = $model->tran_type;
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "mobile_verify_code" => $model->mobile_verify_code,
                "cardCvn2" => $model->cardCvn2,
                "cardExprDt" => $model->cardExprDt,

            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_trusteeship_sign_confirm_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 快捷协议支付
     * @DATA 2021年7月02日下午2:02:09
     */
    public function trusteeshipfastPay($model)
    {
        try {
            $check = $this->common->checkFields(TrusteeshipfastPayRequest::getCheckRules()
                , TrusteeshipfastPayRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.trusteeship.fastPay';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $myParams['tran_type'] = $model->tran_type;
            $myParams['return_url'] = $model->return_url;
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "shopdate" => $model->shopdate,
                "subject" => $model->subject,
                "total_amount" => $model->total_amount,
                "currency" => $model->currency,
                "seller_id" => $model->seller_id,
                "seller_name" => $model->seller_name,
                "timeout_express" => $model->timeout_express,
                "extend_params" => $model->extend_params,
                "extra_common_param" => $model->extra_common_param,
                "business_code" => $model->business_code,
                "protocol_no" => $model->protocol_no,
                "cardCvn2" => $model->cardCvn2,
                "cardExprDt" => $model->cardExprDt,
                "consignee_info" => $model->consignee_info,
                "user_id" => $model->user_id,
                "province" => $model->province,
                "city" => $model->city,
                "mccs" => $model->mccs,
                "mer_no" => $model->mer_no,

            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_trusteeship_fastPay_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


}