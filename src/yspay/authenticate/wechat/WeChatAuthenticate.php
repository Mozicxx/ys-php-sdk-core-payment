<?php
namespace Yspay\SDK;


use Exception;
use Yspay\SDK\Gathering\Kernel\Common;
use Yspay\SDK\Gathering\Payment\Common\Models\Response;
use Yspay\SDK\Model\AuthenticateApplyQueryRequest;
use Yspay\SDK\Model\WeChatAuthenticateApplyRequest;
use Yspay\SDK\Model\WechatAuthenticateRequest;
use Yspay\SDK\Model\WeChatUploadPicRequest;


include_once dirname(dirname(dirname(__FILE__))) . '\Common.php';


class WeChatAuthenticate
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
     * @Desc 微信实名认证开户意愿申请
     * @DATA 2021年7月12日下午2:02:09
     */
    public function WeChatAuthenticateApply($model)
    {
        try {
            $check = $this->common->checkFields(WeChatAuthenticateApplyRequest::getCheckRules()
                , WeChatAuthenticateApplyRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.authenticate.wx.apply';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charset;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;

            $bizReqJson = array(
                "usercode" => $model->usercode,
                "cust_name" => $model->cust_name,
                "contact_cert_type" => $model->contact_cert_type,
                "legal_cert_initial" => $model->legal_cert_initial,
                "legal_cert_expire" => $model->legal_cert_expire,
                "bus_license_initial" => $model->bus_license_initial,
                "bus_license_expire" => $model->bus_license_expire,
                "store_type" => $model->store_type,
                "store_name" => $model->store_name,
                "token" => $model->token,
                "contact_cert_no" => $this->common->encryptDes($model->contact_cert_no, $this->kernel->partner_id),

            );
            $myParams = $this->common->encodeParams($myParams, $bizReqJson);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_authenticate_wx_apply_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }

    /**
     * lfk
     * @Desc 图片上传口令获取
     * @DATA 2021年7月12日下午2:02:09
     */
    public function registerTokenGet()
    {
        try {

            $myParams = array();
            $myParams['method'] = 'ysepay.merchant.register.token.get';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charsetGBK;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;

            $bizReqJson = array();
            //  $bizReqJson = $this->common->unsetArry($bizReqJson);
            $myParams['biz_content'] = "{}";//构造字符串
            ksort($myParams);
            $signStr = $this->common->signSort($myParams);
            $sign = $this->common->sign_encrypt(array('data' => $signStr));
            $myParams['sign'] = trim($sign['check']);
            $url = 'https://register.ysepay.com:2443/register_gateway/gateway.do';
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_merchant_register_token_get_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }

    /**
     * lfk
     * @Desc 图片上传
     * @DATA 2021年7月12日下午2:02:09
     */
    public function weChatUploadPic($model)
    {
        try {
            $check = $this->common->checkFields(WeChatUploadPicRequest::getCheckRules()
                , WeChatUploadPicRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }

            $myParams = array();
            $myParams['superUsercode'] = $model->superUsercode;
            $myParams['picType'] = $model->picType;
            $myParams['token'] = $model->token;

            $filePath = $this->common->str_to_utf8($model->filePath);
            $filename = $this->common->str_to_utf8($model->filename);

            var_dump($filePath);
            var_dump($filename);
            $curl_file = curl_file_create(iconv('utf-8', 'gbk', $filePath), 'image/jpeg', $filename);
            $myParams['picFile'] = $curl_file;
            $url = 'https://uploadApi.ysepay.com:2443/yspay-upload-service?method=upload';
            $responses = new Response();
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $myParams);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $response = curl_exec($ch);
            var_dump($response);
            if (curl_errno($ch)) {
                $curl_errno = curl_errno($ch);
                var_dump($curl_errno);
            }
            $response = json_decode($response, true);

            return Response::setMap($response);
            //  return $this->common->post_Url($url, $myParams, "ysepay_online_fastpay_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 查询微信实名认证申请单状态
     * @DATA 2021年7月12日下午2:02:09
     */
    public function authenticateQuery($model)
    {
        try {
            $check = $this->common->checkFields(WechatAuthenticateRequest::getCheckRules()
                , WechatAuthenticateRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.authenticate.wx.query';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charsetGBK;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;

            $bizReqJson = array(
                "apply_no" => $model->apply_no,
            );
            $myParams = $this->common->encodeParams($myParams, $bizReqJson);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_authenticate_wx_query_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }


    /**
     * lfk
     * @Desc 微信实名认证-撤销申请单
     * @DATA 2021年7月12日下午2:02:09
     */
    public function authenticateApplyCancel($model)
    {
        try {
            $check = $this->common->checkFields(WechatAuthenticateRequest::getCheckRules()
                , WechatAuthenticateRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.authenticate.wx.apply.cancel';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charsetGBK;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;

            $bizReqJson = array(
                "apply_no" => $model->apply_no,
            );
            $myParams = $this->common->encodeParams($myParams, $bizReqJson);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_authenticate_wx_apply_cancel_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }

    /**
     * lfk
     * @Desc 查询微信实名认证授权状态
     * @DATA 2021年7月12日下午2:02:09
     */
    public function authenticateApplyQuery($model)
    {
        try {
            $check = $this->common->checkFields(AuthenticateApplyQueryRequest::getCheckRules()
                , AuthenticateApplyQueryRequest::getParam($model));//数据校验
            if ($check->checkFlag != true) {
                return $check;
            }
            $myParams = array();
            $myParams['method'] = 'ysepay.authenticate.wx.authorized.query';
            $myParams['partner_id'] = $this->kernel->partner_id;
            $myParams['timestamp'] = date('Y-m-d H:i:s');;
            $myParams['charset'] = $this->kernel->charsetGBK;
            $myParams['sign_type'] = $this->kernel->sign_type;
            $myParams['notify_url'] = $this->kernel->notify_url;
            $myParams['version'] = $this->kernel->version;

            $bizReqJson = array(
                "usercode" => $model->usercode,
            );
            $myParams = $this->common->encodeParams($myParams, $bizReqJson);
            $url = $this->kernel->url;
            var_dump($myParams);
            return $this->common->post_Url($url, $myParams, "ysepay_authenticate_wx_authorized_query_response", false);
        } catch (Exception $e) {
            $responses = new Response();
            //  $responses->responseCode = $this->common->param['errorCode'];
            $responses->responseMeg = $e->getMessage();
            return $responses;
        }
    }

}