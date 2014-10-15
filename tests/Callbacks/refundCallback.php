<?php
namespace Omnipay\EpayTests\Callbacks;

class refundCallback
{

    public function credit()
    {
        $class = new \stdClass();
        $class->creditResult = 'credit result';
        $class->pbsresponse = -1;
        $class->epayresponse = -1;
        return $class;
    }

}
 