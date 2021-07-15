<?php

namespace Yspay\SDK;


use Exception;
use Yspay\SDK\Gathering\Kernel\Common;
use Yspay\SDK\Gathering\Payment\Common\Models\Response;
use Yspay\SDK\Model\AlijsapiRequest;
use Yspay\SDK\Model\BarcodepayRequest;
use Yspay\SDK\Model\CupgetmulappUseridRequest;
use Yspay\SDK\Model\CupmulappQrcodepayRequest;
use Yspay\SDK\Model\MobileControlsPayRequest;
use Yspay\SDK\Model\QrcodepayRequest;
use Yspay\SDK\Model\TradeDeliveredRequest;
use Yspay\SDK\Model\WeixinPayRequest;


include_once dirname(dirname(dirname(__FILE__))) . '\Common.php';


class Pay
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
     * @Desc 担保交易发货通知
     * @DATA 2021年7月01日下午2:02:09
     */
    public function tradeDelivered($model)
    {
        try {
            $check = $this->common->checkFields(TradeDeliveredRequest::getCheckRules()
                , TradeDeliveredRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.online.trade.delivered';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "shopdate" => $model->shopdate,
                "trade_no" => $model->trade_no,
            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_trade_delivered_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }

    /**
     * lfk
     * @Desc 担保交易确认收货
     * @DATA 2021年7月01日下午2:02:09
     */
    public function tradeConfirm($model)
    {
        try {
            $check = $this->common->checkFields(TradeDeliveredRequest::getCheckRules()
                , TradeDeliveredRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.online.trade.confirm';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "shopdate" => $model->shopdate,
                "trade_no" => $model->trade_no,
            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_trade_confirm_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 反扫码支付
     * @DATA 2021年7月01日下午2:02:09
     */
    public function barcodepay($model)
    {
        try {
            $check = $this->common->checkFields(BarcodepayRequest::getCheckRules()
                , BarcodepayRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.online.barcodepay';
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
                "bank_type" => $model->bank_type,
                "scene" => $model->scene,
                "auth_code" => $model->auth_code,
                "device_info" => $model->device_info,
                "category" => $model->category,
                "mrchntCertId" => $model->mrchntCertId,
                "consignee_info" => $model->consignee_info,
                "cross_border_info" => $model->cross_border_info,
                "appid" => $model->appid,
                "province" => $model->province,
                "city" => $model->city,
                "limit_credit_pay" => $model->limit_credit_pay,
                "hb_fq_num" => $model->hb_fq_num,
                "allow_repeat_pay" => $model->allow_repeat_pay,
                "fail_notify_url" => $model->fail_notify_url

            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->qrcodeUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_barcodepay_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }

    /**
     * lfk
     * @Desc 支付宝生活号支付
     * @DATA 2021年7月01日下午2:02:09
     */
    public function alijsapi($model)
    {
        try {
            $check = $this->common->checkFields(AlijsapiRequest::getCheckRules()
                , AlijsapiRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.online.alijsapi.pay';
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
                "buyer_logon_id" => $model->buyer_logon_id,
                "buyer_id" => $model->buyer_id,
                "consignee_info" => $model->consignee_info,
                "province" => $model->province,
                "city" => $model->city,
                "limit_credit_pay" => $model->limit_credit_pay,
                "hb_fq_num" => $model->hb_fq_num,
                "allow_repeat_pay" => $model->allow_repeat_pay,
                "fail_notify_url" => $model->fail_notify_url,


            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->qrcodeUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_alijsapi_pay_response", true);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 微信公众号、小程序支付
     * @DATA 2021年7月01日下午2:02:09
     */
    public function weixinPay($model)
    {
        try {
            $check = $this->common->checkFields(WeixinPayRequest::getCheckRules()
                , WeixinPayRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.online.weixin.pay';
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
                "sub_openid" => $model->sub_openid,
                "is_minipg" => $model->is_minipg,
                "appid" => $model->appid,
                "province" => $model->province,
                "city" => $model->city,
                "mer_amount" => $model->mer_amount,
                "limit_credit_pay" => $model->limit_credit_pay,
                "allow_repeat_pay" => $model->allow_repeat_pay,
                "fail_notify_url" => $model->fail_notify_url,


            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->qrcodeUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_barcodepay_response", true);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }

    /**
     * lfk
     * @Desc 行业码获取用户标识
     * @DATA 2021年7月01日下午2:02:09
     */
    public function cupgetmulappUserid($model)
    {
        try {
            $check = $this->common->checkFields(CupgetmulappUseridRequest::getCheckRules()
                , CupgetmulappUseridRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.online.cupgetmulapp.userid';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $myParams['tran_type'] = $model->tran_type;
            $bizReqJson = array(
                "userAuthCode" => $model->userAuthCode,
                "appUpIdentifier" => $model->appUpIdentifier,

            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->qrcodeUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_cupgetmulapp_userid_response", true);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 行业码支付
     * @DATA 2021年7月01日下午2:02:09
     */
    public function cupmulappQrcodepay($model)
    {
        try {
            $check = $this->common->checkFields(CupmulappQrcodepayRequest::getCheckRules()
                , CupmulappQrcodepayRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.online.cupmulapp.qrcodepay';
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
                "bank_type" => $model->bank_type,
                "consignee_info" => $model->consignee_info,
                "userId" => $model->userId,
                "device_info" => $model->device_info,
                "terminal_info" => $model->terminal_info,
                "limit_credit_pay" => $model->limit_credit_pay,
                "hb_fq_num" => $model->hb_fq_num,
                "allow_repeat_pay" => $model->allow_repeat_pay,
                "fail_notify_url" => $model->fail_notify_url,
                "spbill_create_ip" => $model->spbill_create_ip,
            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->qrcodeUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_cupmulapp_qrcodepay_response", true);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 正扫支付
     * @DATA 2021年7月01日下午2:02:09
     */
    public function qrcodepay($model)
    {
        try {
            $check = $this->common->checkFields(QrcodepayRequest::getCheckRules()
                , QrcodepayRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.online.qrcodepay';
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
                "bank_type" => $model->bank_type,
                "consignee_info" => $model->consignee_info,
                "cross_border_info" => $model->cross_border_info,
                "appid" => $model->appid,
                "province" => $model->province,
                "city" => $model->city,
                "limit_credit_pay" => $model->limit_credit_pay,
                "hb_fq_num" => $model->hb_fq_num,
                "tran_type" => $model->tran_type,
                "return_url" => $model->return_url,

            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->qrcodeUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_qrcodepay_response", true);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 手机控件支付
     * @DATA 2021年7月01日下午2:02:09
     */
    public function mobileControlsPay($model)
    {
        try {
            $check = $this->common->checkFields(MobileControlsPayRequest::getCheckRules()
                , MobileControlsPayRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.online.mobile.controls.pay';
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
                "bank_type" => $model->bank_type,
                "bank_account_type" => $model->bank_account_type,
                "support_card_type" => $model->support_card_type,
                "cross_border_info" => $model->cross_border_info,
                "consignee_info" => $model->consignee_info,

            );
            $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = json_encode($bizReqJson, 320);//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);

            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_mobile_controls_pay_response", true);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }

}