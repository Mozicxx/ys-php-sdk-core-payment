<?php
namespace Yspay\SDK\Gathering;
include_once "../../src/yspay/Factory.php";
include_once "../../src/yspay/util/ResponseChecker.php";
include_once "../../src/yspay/Config.php";


use PHPUnit\Framework\TestCase;
use Yspay\Gathering\SDK\Factory;
use Yspay\SDK\Gathering\Kernel\Config;


class Base extends TestCase
{

    public static $Factory;

    function __construct()
    {
        parent::__construct();
        Factory::instance($this->getOptions());
    }

    public static function instance()
    {
        self::$Factory = new self();

        return self::$Factory;
    }


    function getOptions()
    {

        $options = new Config();
        //<-- 环境 -->;
        $options->postType = 'prd';
        //<-- 加签私钥证书文件路径 -->
        //$options->private_key = "D:\银盛集团\smfws\yzt-php-sdk-core\yzt-gathering-sdk\src\yspay\certs\hyfz_test2.pfx";
        $options->private_key = "D:\PHP\php\ys-php-sdk-core\src\yspay\certs\hyfz_test.pfx";
        //验签公钥证书文件路径
      //  $options->businessgatecerpath = "D:\银盛集团\smfws\yzt-php-sdk-core\yzt-gathering-sdk\src\yspay\certs\businessgate.cer";
        $options->pfxpassword = "123456";
        $options->partner_id = "hyfz_test2";
        $options->notify_url = "http://wiki.easybuycloud.com:8082/ysmp-notify-ci/testnotify";


        return $options;
    }


}