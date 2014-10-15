<?php
namespace Omnipay\EpayTests\Callbacks;

class captureCallback
{

    public function capture()
    {
        $class = new \stdClass();
        $class->captureResult = 'capture result';
        $class->pbsResponse = -1;
        $class->epayresponse = -1;
        return $class;
    }

}
 