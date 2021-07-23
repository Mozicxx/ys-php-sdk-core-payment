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
            $myParams = $this->common->commonHeads('ysepay.online.fastpay', $this->kernel, $model);
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
                "cardCvn2" => $this->common->encryptDes($model->cardCvn2,$this->kernel->partner_id),
                "cardExprDt" => $this->common->encryptDes($model->cardExprDt,$this->kernel->partner_id),
                "pyerIDTp" => $this->common->encryptDes($model->pyerIDTp,$this->kernel->partner_id),
                "pyerIDNo" => $this->common->encryptDes($model->pyerIDNo,$this->kernel->partner_id),
                "consignee_info" => $model->consignee_info,
                "cross_border_info" => $model->cross_border_info,
                "province" => $model->province,
                "city" => $model->city,
                "limit_credit_pay" => $model->limit_credit_pay,
                "mccs" => $model->mccs,
                "mer_no" => $model->mer_no,


            );
            $myParams = $this->common->encodeParams($myParams,$bizReqJson);
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
            $myParams = $this->common->commonHeads('ysepay.online.fastpay.authorize', $this->kernel, $model);
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "buyer_mobile" => $model->buyer_mobile,
                "mobile_verify_code" => $model->mobile_verify_code,
                "cardCvn2" => $this->common->encryptDes($model->cardCvn2,$this->kernel->partner_id),
                "cardExprDt" => $this->common->encryptDes($model->cardExprDt,$this->kernel->partner_id)

            );
            $myParams = $this->common->encodeParams($myParams,$bizReqJson);
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
            $myParams = $this->common->commonHeads('ysepay.online.fastpay.authorize.msg', $this->kernel, $model);
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,

            );
            $myParams = $this->common->encodeParams($myParams,$bizReqJson);
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
            $myParams = $this->common->commonHeads('ysepay.trusteeship.sign', $this->kernel, $model);
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "seller_id" => $model->seller_id,
                "seller_name" => $model->seller_name,
                "total_amount" => $model->total_amount,
                "buyer_name" => $this->common->encryptDes($model->buyer_name,$this->kernel->partner_id),
                "buyer_card_number" => $this->common->encryptDes($model->buyer_card_number,$this->kernel->partner_id),
                "buyer_mobile" => $this->common->encryptDes($model->buyer_mobile,$this->kernel->partner_id),
                "cardCvn2" => $this->common->encryptDes($model->cardCvn2,$this->kernel->partner_id),
                "cardExprDt" => $this->common->encryptDes($model->cardExprDt,$this->kernel->partner_id),
                "pyerIDNo" => $this->common->encryptDes($model->pyerIDNo,$this->kernel->partner_id),
                "imei" => $model->imei,
                "actionScope" => $model->actionScope,
                "user_id" => $model->user_id,

            );
            $myParams = $this->common->encodeParams($myParams,$bizReqJson);
            $url = $this->kernel->trusteeshipUrl;
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
            $myParams = $this->common->commonHeads('ysepay.trusteeship.sign.confirm', $this->kernel, $model);
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "mobile_verify_code" => $model->mobile_verify_code,
                "cardCvn2" => $this->common->encryptDes($model->cardCvn2,$this->kernel->partner_id),
                "cardExprDt" => $this->common->encryptDes($model->cardExprDt,$this->kernel->partner_id),

            );
            $myParams = $this->common->encodeParams($myParams,$bizReqJson);
            $url = $this->kernel->trusteeshipUrl;
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
            $myParams = $this->common->commonHeads('ysepay.trusteeship.fastPay', $this->kernel, $model);
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
                "cardCvn2" => $this->common->encryptDes($model->cardCvn2,$this->kernel->partner_id),
                "cardExprDt" => $this->common->encryptDes($model->cardExprDt,$this->kernel->partner_id),
                "consignee_info" => $model->consignee_info,
                "user_id" => $model->user_id,
                "province" => $model->province,
                "city" => $model->city,
                "mccs" => $model->mccs,
                "mer_no" => $model->mer_no,

            );
            $myParams = $this->common->encodeParams($myParams,$bizReqJson);
            $url = $this->kernel->trusteeshipUrl;
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