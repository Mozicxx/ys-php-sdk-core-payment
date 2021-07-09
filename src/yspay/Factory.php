<?php

namespace Yspay\Gathering\SDK;
include_once "gather/pay/Pay.php";
include_once "gather/fastpay/Fastpay.php";
include_once "gather/pagepay/PagePay.php";
include_once "replace/replcepay/ReplcePay.php";


use Yspay\SDK\Pay as payClass;
use Yspay\SDK\Fastpay as fastpayClass;
use Yspay\SDK\PagePay as pagePayClass;
use Yspay\SDK\ReplcePay as replcePayClass;



class Factory
{
    public $kernel = null;
    public $factory = null;
    private static $instance;
    public static $payClient;
    public static $fastpayClient;
    public static $pagePayClient;
    public static $replcePayClient;


    protected static $util;

    private function __construct($config)
    {
        $postType = $config->postType;
        if (null != $config) {
            if ($postType == "test"){
                $config->url = 'https://openapi.ysepay.com/gateway.do';
            }else if ($postType == "prd"){
                $config->url = 'https://openapi.ysepay.com/gateway.do';
            }else{
                var_dump( "环境类型不存在");
            }
        }
        self::$payClient = new PayClient($config);
        self::$fastpayClient = new FastpayClient($config);
        self::$pagePayClient = new PagePayClient($config);
        self::$replcePayClient = new ReplcePayClient($config);


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

