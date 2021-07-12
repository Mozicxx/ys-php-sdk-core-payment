<?php

namespace Yspay\Gathering\SDK;
include_once "gather/pay/Pay.php";
include_once "gather/fastpay/Fastpay.php";
include_once "gather/pagepay/PagePay.php";
include_once "replace/replcepay/ReplcePay.php";
include_once "common/order/OrderRefund.php";
include_once "common/division/Division.php";
include_once "common/merchant/Merchant.php";


use Yspay\SDK\Pay as payClass;
use Yspay\SDK\Fastpay as fastpayClass;
use Yspay\SDK\PagePay as pagePayClass;
use Yspay\SDK\ReplcePay as replcePayClass;
use Yspay\SDK\OrderRefund as orderRefundClass;
use Yspay\SDK\Merchant as merchantClass;
use Yspay\SDK\Division as divisionClass;



class Factory
{
    public $kernel = null;
    public $factory = null;
    private static $instance;
    public static $payClient;
    public static $fastpayClient;
    public static $pagePayClient;
    public static $replcePayClient;
    public static $orderRefundClient;
    public static $divisionClient;
    public static $merchantClient;


    protected static $util;

    private function __construct($config)
    {
        $postType = $config->postType;
        if (null != $config) {
            if ($postType == "test"){
                $config->url = 'https://openapi.ysepay.com/gateway.do';
                $config->dfUrl = 'https://df.ysepay.com/gateway.do';
                $config->dfOderUrl = 'https://searchdf.ysepay.com/gateway.do';
            }else if ($postType == "prd"){
                $config->url = 'https://openapi.ysepay.com/gateway.do';
                $config->dfUrl = 'https://df.ysepay.com/gateway.do';
                $config->dfOderUrl = 'https://searchdf.ysepay.com/gateway.do';
            }else{
                var_dump( "环境类型不存在");
            }
        }
        self::$payClient = new PayClient($config);
        self::$fastpayClient = new FastpayClient($config);
        self::$pagePayClient = new PagePayClient($config);
        self::$replcePayClient = new ReplcePayClient($config);
        self::$orderRefundClient = new OrderRefundClient($config);
        self::$divisionClient = new DivisionClient($config);
        self::$merchantClient = new MerchantClient($config);


    }


    public static function instance($config)
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self($config);
        }

        return self::$instance;
    }

    private function __clone()
    {
    }


    public static function payClient()
    {
        return self::$payClient;
    }
    public static function fastpayClient()
    {
        return self::$fastpayClient;
    }
    public static function pagePayClient()
    {
        return self::$pagePayClient;
    }
    public static function replcePayClient()
    {
        return self::$replcePayClient;
    }



}


class PayClient
{
    private $kernel;

    public function __construct($kernel)
    {
        $this->kernel = $kernel;
    }

    public function payClass()
    {
        return new payClass($this->kernel);
    }

}

class fastpayClient
{
    private $kernel;

    public function __construct($kernel)
    {
        $this->kernel = $kernel;
    }

    public function fastpayClass()
    {
        return new fastpayClass($this->kernel);
    }

}

class PagePayClient
{
    private $kernel;

    public function __construct($kernel)
    {
        $this->kernel = $kernel;
    }

    public function pagePayClass()
    {
        return new pagePayClass($this->kernel);
    }

}


class ReplcePayClient
{
    private $kernel;

    public function __construct($kernel)
    {
        $this->kernel = $kernel;
    }

    public function replcePayClass()
    {
        return new replcePayClass($this->kernel);
    }

}

class OrderRefundClient
{
    private $kernel;

    public function __construct($kernel)
    {
        $this->kernel = $kernel;
    }

    public function orderRefundClass()
    {
        return new orderRefundClass($this->kernel);
    }

}

class DivisionClient
{
    private $kernel;

    public function __construct($kernel)
    {
        $this->kernel = $kernel;
    }

    public function divisionClass()
    {
        return new divisionClass($this->kernel);
    }

}

class MerchantClient
{
    private $kernel;

    public function __construct($kernel)
    {
        $this->kernel = $kernel;
    }

    public function merchantClass()
    {
        return new merchantClass($this->kernel);
    }

}

