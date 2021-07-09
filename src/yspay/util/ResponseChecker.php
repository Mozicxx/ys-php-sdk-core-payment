<?php


namespace Yspay\SDK\Kernel\Gathering\Util;


class ResponseChecker
{
    public function success($response)
    {
        if (!empty($response->responseCode) && $response->responseCode == "10000") {
            return true;
        }

        return false;
    }
}