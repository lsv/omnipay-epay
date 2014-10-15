<?php
namespace Omnipay\EpayTests\Message\Purchase;

use Omnipay\Epay\Message\Purchase\CompletePurchaseRequest;
use Omnipay\EpayTests\AbstractTest;

class CompletePurchaseRequestTest extends AbstractTest
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

        /** @var CompletePurchaseRequest $complete */
        $complete = $gateway->completePurchase($this->getDataWithHash());
        $this->assertEquals($this->getDataWithHash()['amount'], $complete->getData()['amount']);
        $this->assertInstanceOf('\Omnipay\Epay\Message\Purchase\CompletePurchaseResponse', $complete->send());
    }

    public function test_can_throw_error_on_hashinvalid()
    {
        $this->setExpectedException('\Omnipay\Common\Exception\InvalidResponseException', 'Hash is invalid');
        $gateway = $this->getMockedGateway([
            "txnid" => "10",
            "orderid" => "10",
            "amount" => "20",
            "currency" => "208",
            "hash" => "b892a92b0c8927da3ac8651ad79d8d1"
        ]);

        /** @var CompletePurchaseRequest $complete */
        $complete = $gateway->completePurchase($this->getDataWithHash());
        $this->assertEquals($this->getDataWithHash()['amount'], $complete->getData()['amount']);
    }

    public function test_can_verify_if_hash_is_not_set()
    {
        $gateway = $this->getMockedGateway([
            "txnid" => "10",
            "orderid" => "10",
            "amount" => "20",
            "currency" => "208"
        ]);

        /** @var CompletePurchaseRequest $complete */
        $complete = $gateway->completePurchase($this->getDataWithHash());
        $this->assertEquals($this->getDataWithHash()['amount'], $complete->getData()['amount']);
    }

}
 