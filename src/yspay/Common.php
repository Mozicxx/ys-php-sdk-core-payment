<?php

namespace Yspay\SDK\Gathering\Kernel;

use Exception;
use Yspay\SDK\Gathering\Payment\Common\Models\Response;

include_once "Response.php";

class Common
{
    public $param;
    private $kernel;

    /**
     * 构造函数
     *
     * @access  public
     * @param
     * @return void
     */
    function __construct($kernel)
    {
        $this->build();
        $this->kernel = $kernel;
    }

    /**
     * 实例化固定参数值
     */
    function build()
    {

        $this->param = array();
        // $this->param['businessgatecerpath'] = dirname(dirname(__FILE__)) ."\yspay\certs\ys_test.cer";

        // $this->param['private_key'] = dirname(dirname(__FILE__)) ."\yspay\certs\merchant_test.pfx";
        //  $this->param['pfxpassword'] = 'ysyun';
        //  $this->param['charset'] = 'UTF-8';
        //  $this->param['signType'] = 'RSA';
        //  $this->param['version'] = 'V100';

        //商户网关
        // $this->param['mchUrl'] = 'http://wiki.easybuycloud.com:8082/ysmp-merchant-gateway-ci';
        // $this->param['prodMchUrl'] = 'https://mpfpmerchantapi.ysepay.com';

        // //支付网关
        // $this->param['url'] = 'http://wiki.easybuycloud.com:8082/ysmp-gateway-ci';
        // $this->param['prodUrl'] = 'https://mpfptradeapi.ysepay.com';

        $this->param['unknow'] = 'unknow';
        $this->param['unknowMsg'] = '网络异常，状态未知';

        $this->param['fail'] = 'fail';
        $this->param['failMsg'] = '网络异常，此请求为失败';

        $this->param['verify_sign_fail'] = '验签失败';
        $this->param['sign_fail'] = '签名失败，请检查证书文件是否存在，密码是否正确';
        $this->param['errorCode'] = 'error';
        $this->param['successCode'] = 'success';

        //商户
        $this->param['merchantQuery'] = '/gateway/merchant/query';
        $this->param['merchantAdd'] = '/gateway/merchant/add';
        $this->param['merchantPicUpload'] = '/gateway/file/merchantPic';
        $this->param['updateBindAppId'] = '/gateway/merchant/updateBindAppId';
        $this->param['authSubmitApply'] = '/gateway/merchant/wxAuthSubmitApply';



    }

    //加签排序
    public function signSort($myParams)
    {
        $signStr = "";
        foreach ($myParams as $key => $val) {
            if (!empty($val)){
                $signStr .= $key . '=' . $val . '&';
            }
        }
        return rtrim($signStr, '&');
    }

    //加签排序
    public function unsetArry($bizReqJson)
    {
        foreach( $bizReqJson as $k=>$v){
            if( !$v )
                unset( $bizReqJson[$k] );
        }
        return $bizReqJson;
    }


    //验签排序
    public function attestationSignSort($myParams)
    {
        $signStr = "";
        foreach ($myParams as $key => $val) {
            if ($key == "ysepay_df_single_quick_accept_response") {
                $val = substr($val, 1, -1);
            }

            $signStr .= $key . '=' . $val . '&';
        }
        return rtrim($signStr, '&');
    }

    /**
     * post发送请求
     *
     * @param $url
     * @param $myParams
     * @param $response_name
     * @return Response
     */
    function post_url($url, $myParams, $response_name, $flag = false)
    {
        $responses = new Response();
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($myParams));
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
            curl_close($ch);
            if ($flag) {
                $responses->responseCode = $this->param['unknow'];
                $responses->responseMeg = $this->param['unknowMsg'];
                return $responses;
            }
            $responses->responseCode = $this->param['fail'];
            $responses->responseMeg = $this->param['failMsg'];
            return $responses;
        } else {
            curl_close($ch);
            $response = json_decode($response, true);
            var_dump($response);
            if ($response["sign"] != null) {
                $sign = $response["sign"];
                $data = stripslashes(json_encode($response[$response_name], JSON_UNESCAPED_UNICODE));
                // 验证签名 仅作基础验证
                if ($this->sign_check($sign, $data) == true) {
                    echo "验证签名成功!";
                    return Response::fromMap($response,$response_name);
                } else {
                    echo '验证签名失败!';
                   // $responses->responseCode = $this->param['errorCode'];
                   // $responses->responseMeg = $this->param['verify_sign_fail'];
                    return $responses;
                }
            }
        }
    }


    /**
     * 转码
     */
    function str_to_utf8 ($str = '') {

        $current_encode = mb_detect_encoding($str, array("ASCII","GB2312","GBK",'BIG5','UTF-8'));

        $encoded_str = mb_convert_encoding($str, 'UTF-8', $current_encode);

        return $encoded_str;

    }

    /**
     * 验签转明码
     * @param $sign 签名字符串
     * @param $data
     *
     * @return $success
     */
    function sign_check($sign, $data)
    {
    //  $publickeyFile = $this->kernel->businessgatecerpath; //公钥
    //  $certificateCAcerContent = file_get_contents($publickeyFile);
    //   $certificateCApemContent = '-----BEGIN CERTIFICATE-----' . PHP_EOL . chunk_split(base64_encode($certificateCAcerContent), 64, PHP_EOL) . '-----END CERTIFICATE-----' . PHP_EOL;
   //  print_r($certificateCApemContent);
        // 签名验证
        $success = openssl_verify($data, base64_decode($sign), openssl_get_publickey($this->kernel->publicKey), OPENSSL_ALGO_SHA1);
        return $success;
    }




    /**
     * 签名加密
     * @param input data
     * @return Response
     * @return check
     * @return msg
     */
    function sign_encrypt($input)
    {

        try {
            $MERCHANT_PRX = $this->kernel->private_key;
            $MERCHANT_PRX_PWD = $this->kernel->pfxpassword;
            $return = array('success' => 0, 'msg' => '', 'check' => '');
            $pkcs12 = file_get_contents($MERCHANT_PRX);
            if (openssl_pkcs12_read($pkcs12, $certs, $MERCHANT_PRX_PWD)) {
                var_dump('证书,密码,正确读取');
                $privateKey = $certs['pkey'];
                $publicKey = $certs['cert'];
                $signedMsg = "";
                // print_r("加密密钥" . $privateKey);
                echo "加密数据" . $input['data'];
                if (openssl_sign($input['data'], $signedMsg, $privateKey, OPENSSL_ALGO_SHA1)) {
                    var_dump('签名正确生成');
                    $return['success'] = 1;
                    $return['check'] = base64_encode($signedMsg);
                    $return['msg'] = base64_encode($input['data']);
                }
            }
            return $return;
        } catch (Exception $e) {
            throw new Exception($this->param['sign_fail']);
        }

    }


    function checkFields($rules, $data)
    {
        $response = new Response();
        foreach ($rules as $field => $fieldRules) {
            if (!isset($data[$field])) {
                $response->responseCode = "error";
                $response->responseMeg = "$field 不能为空";
                $response->checkFlag = false;
                return $response;
            }
        }

        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $type => $rule) {
                $ret = Validator::check($type, $data[$field], $rule);
                if ($ret == false) {

                    $response->responseCode = "error";
                    $response->responseMeg = "param : $field 参数错误";
                    $response->checkFlag = false;
                    return $response;
                }
            }
        }
        $response->checkFlag = true;
        return $response;
    }



    /**
     * des加密函数
     */
    public function encryptDes($input, $key)
    {
        if (!isset($input) || !isset($key)) {
            return "";
        }
        $key = substr($this->kernel->partner_id, 0, 8);
        $sprintf = sprintf("% s", $key);

            return $this->encrypt($input,$sprintf);
    }


    public function encrypt($input,$key)
    {
        $data = openssl_encrypt($input, 'DES-ECB', $key, OPENSSL_RAW_DATA, $this->hexToStr(""));
        $data = base64_encode($data);
        return $data;
    }

    public function decrypt($input,$key)
    {
        $decrypted = openssl_decrypt(base64_decode($input), 'DES-ECB', $key, OPENSSL_RAW_DATA, $this->hexToStr(""));
        return $decrypted;
    }

    function hexToStr($hex)
    {
        $string='';
        for ($i=0; $i < strlen($hex)-1; $i+=2)
        {
            $string .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return $string;
    }


}