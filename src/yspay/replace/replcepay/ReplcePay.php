<?php
namespace Yspay\SDK;


use Exception;
use Yspay\SDK\Gathering\Kernel\Common;
use Yspay\SDK\Gathering\Payment\Common\Models\Response;
use Yspay\SDK\Model\DfBillDownloadurlGetRequest;
use Yspay\SDK\Model\DfSingleQuickAcceptRequest;
use Yspay\SDK\Model\DSingleQuickQueryRequest;
use Yspay\SDK\Model\WapDirectpayCreatebyuserReq;


include_once dirname(dirname(dirname(__FILE__))) . '\Common.php';


class ReplcePay
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
     * @Desc 单笔代付交易（银行卡）
     * @DATA 2021年7月08日下午2:02:09
     */
    public function dfSingleQuickAccept($model)
    {
        try {
            $check = $this->common->checkFields(DfSingleQuickAcceptRequest::getCheckRules()
                , DfSingleQuickAcceptRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.df.single.quick.accept';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $myParams['proxy_password'] = $model->proxy_password;
            $myParams['merchant_usercode'] = $model->merchant_usercode;
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "shopdate" => $model->shopdate,
                "total_amount" => $model->total_amount,
                "currency" => $model->currency,
                "bank_city" => $model->bank_city,
                "bank_province" => $model->bank_province,
                "business_code" => $model->business_code,
                "subject" => $model->subject,
                "bank_name" => $model->bank_name,
                "bank_account_name" => $model->bank_account_name,
                "bank_card_type" => $model->bank_card_type,
                "bank_telephone_no" => $model->bank_telephone_no,
                "bank_account_type" => $model->bank_account_type,
                "bank_account_no" => $model->bank_account_no,
                "cert_type" => $model->cert_type,
                "cert_no" => $model->cert_no,
                "cert_expire" => $model->cert_expire,
                "consignee_info" => $model->consignee_info,
                "proxy_password" => $model->proxy_password,
                "merchant_usercode" => $model->merchant_usercode,

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
            $responses->responseMeg = $e->getMessage();;
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 单笔代付交易（平台内）
     * @DATA 2021年7月08日下午2:02:09
     */
    public function dfSingleQuickInnerAccept($model)
    {
        try {
            $check = $this->common->checkFields(DfSingleQuickAcceptRequest::getCheckRules()
                , DfSingleQuickAcceptRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.df.single.quick.inner.accept';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $myParams['proxy_password'] = $model->proxy_password;
            $myParams['merchant_usercode'] = $model->merchant_usercode;
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "shopdate" => $model->shopdate,
                "total_amount" => $model->total_amount,
                "currency" => $model->currency,
                "bank_city" => $model->bank_city,
                "bank_province" => $model->bank_province,
                "business_code" => $model->business_code,
                "subject" => $model->subject,
                "bank_name" => $model->bank_name,
                "bank_account_name" => $model->bank_account_name,
                "bank_card_type" => $model->bank_card_type,
                "bank_telephone_no" => $model->bank_telephone_no,
                "bank_account_type" => $model->bank_account_type,
                "bank_account_no" => $model->bank_account_no,
                "cert_type" => $model->cert_type,
                "cert_no" => $model->cert_no,
                "cert_expire" => $model->cert_expire,
                "consignee_info" => $model->consignee_info,
                "proxy_password" => $model->proxy_password,
                "merchant_usercode" => $model->merchant_usercode,


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
            $responses->responseMeg = $e->getMessage();;
            return $responses;
        }
    }



    /**
     * lfk
     * @Desc 单笔代付查询
     * @DATA 2021年7月08日下午2:02:09
     */
    public function dfSingleQuickQuery($model)
    {
        try {
            $check = $this->common->checkFields(DSingleQuickQueryRequest::getCheckRules()
                , DSingleQuickQueryRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.df.single.query';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $myParams['proxy_password'] = $model->proxy_password;
            $myParams['merchant_usercode'] = $model->merchant_usercode;
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
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_online_trade_delivered_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();;
            return $responses;
        }
    }



    /**
     * lfk
     * @Desc 单笔代付对账单
     * @DATA 2021年7月08日下午2:02:09
     */
    public function dfBillDownloadurlGet($model)
    {
        try {
            $check = $this->common->checkFields(DfBillDownloadurlGetRequest::getCheckRules()
                , DfBillDownloadurlGetRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.df.bill.downloadurl.get';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;
            $myParams['proxy_password'] = $model->proxy_password;
            $myParams['merchant_usercode'] = $model->merchant_usercode;
            $bizReqJson = array(
                "account_date" => $model->account_date,
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
            $responses->responseMeg = $e->getMessage();;
            return $responses;
        }
    }


}