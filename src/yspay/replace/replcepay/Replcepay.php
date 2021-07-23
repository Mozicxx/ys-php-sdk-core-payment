<?php
namespace Yspay\SDK;


use Exception;
use Yspay\SDK\Gathering\Kernel\Common;
use Yspay\SDK\Gathering\Payment\Common\Models\Response;
use Yspay\SDK\Model\DfBillDownloadurlGetRequest;
use Yspay\SDK\Model\DfSingleQuickAcceptRequest;
use Yspay\SDK\Model\DfSingleQuickInnerAcceptReq;
use Yspay\SDK\Model\DSingleQuickQueryRequest;
use Yspay\SDK\Model\WapDirectpayCreatebyuserReq;


include_once dirname(dirname(dirname(__FILE__))) . '\Common.php';


class Replcepay
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
            $myParams = $this->common->commonHeads('ysepay.df.single.quick.accept', $this->kernel, $model);
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
                "cert_no" => $this->common->encryptDes($model->cert_no, $this->kernel->partner_id),
                "cert_expire" => $model->cert_expire,
                "consignee_info" => $model->consignee_info,
                "proxy_password" => $model->proxy_password,
                "merchant_usercode" => $model->merchant_usercode,

            );
            $myParams = $this->common->encodeParams($myParams,$bizReqJson);
            $url = $this->kernel->dfUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_df_single_quick_accept_response", false);
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
            $check = $this->common->checkFields(DfSingleQuickInnerAcceptReq::getCheckRules()
                , DfSingleQuickInnerAcceptReq::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = $this->common->commonHeads('ysepay.df.single.quick.inner.accept', $this->kernel, $model);
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "shopdate" => $model->shopdate,
                "total_amount" => $model->total_amount,
                "currency" => $model->currency,
                "business_code" => $model->business_code,
                "subject" => $model->subject,
                "payee_cust_name" => $model->payee_cust_name,
                "payee_user_code" => $model->payee_user_code,
                "telephone_no" => $model->telephone_no,
                "proxy_password" => $model->proxy_password,
                "merchant_usercode" => $model->merchant_usercode,

            );
            $myParams = $this->common->encodeParams($myParams,$bizReqJson);
            $url = $this->kernel->dfUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_df_single_quick_inner_accept_response", false);
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
            $myParams = $this->common->commonHeads('ysepay.df.single.query', $this->kernel, $model);
            $bizReqJson = array(
                "out_trade_no" => $model->out_trade_no,
                "shopdate" => $model->shopdate,
            );
            $myParams = $this->common->encodeParams($myParams,$bizReqJson);
            $url = $this->kernel->dfOderUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_df_single_query_response", false);
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
            $myParams = $this->common->commonHeads('ysepay.df.bill.downloadurl.get', $this->kernel, $model);
            $bizReqJson = array(
                "account_date" => $model->account_date,
            );
            $myParams = $this->common->encodeParams($myParams,$bizReqJson);
            $url = $this->kernel->dfOderUrl;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_df_bill_downloadurl_get_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();;
            return $responses;
        }
    }


}