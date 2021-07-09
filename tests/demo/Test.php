<?php
use PHPUnit\Framework\TestCase;

include_once "../../src/yspay/util/Validator.php";

class Test extends TestCase
{


    function checkFields($rules, $data) {
        foreach ($rules as $field => $fieldRules) {
            if (!isset($data[$field])) {
                echo "$field 不能为空";
                return false;
            }
        }

        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $type => $rule) {
                $ret = Validator::check($type, $data[$field], $rule);
                if ($ret == false) {
                    echo "param $field 参数错误";
                    return false;
                }
            }
        }

        return true;
    }
    function test02(){
        function dd($a,$b,$c = '4'){
            echo $a.$b.$c;
        }

        dd("1","2","5");

    }



    function test01(){
        global $checkRules;

        $checkRules = array(
            '/a/b' => [
                'name' => [
                    Validator::MIN_LEN => 1,
                    Validator::MAX_LEN => 7,
                ],
                'age' => [
                    Validator::MAX_LEN => 3,
                ],
            ],

        );



        $params = array(
            'name' => 'zhoumin',
        );
        $ret = $this->checkFields($checkRules['/a/b'], $params);
        if ($ret == false) {
            echo "参数错误";
            return;
        } else {
            echo "参数正确";
        }




    }




}