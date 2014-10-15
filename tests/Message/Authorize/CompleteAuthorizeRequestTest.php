<?php
namespace Omnipay\EpayTests\Message\Authorize;

use Omnipay\Epay\Message\Authorize\CompleteAuthorizeRequest;
use Omnipay\EpayTests\AbstractTest;

class CompleteAuthorizeRequestTest extends AbstractTest
{

    public function test_can_complete_request()
    {
        $gateway = $this->getMockedGateway([
            "txnid" => "33188791",
            "orderid" => "b98914102014160534",
            "amount" => "20",
            "currency" => "208",
            "date" => "20141014",
            "time" => "1606",
            "txnfee" => "70",
            "paymenttype" => "1",
            "cardno" => "444444XXXXXX4000",
            "hash" => "b892a92b0c8927da3ac8651ad79d8d1c"
        ]);

        /** @var CompleteAuthorizeRequest $complete */
        $complete = $gateway->completeAuthorize($this->getDataWithHash());
        $this->assertEquals($this->getDataWithHash()['amount'], $complete->getData()['amount']);
        $this->assertInstanceOf('\Omnipay\Epay\Message\Authorize\CompleteAuthorizeResponse', $complete->send());
    }

}
 