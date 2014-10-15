<?php
namespace Omnipay\EpayTests\Message\Purchase;

use Omnipay\Epay\Message\Purchase\CompletePurchaseRequest;
use Omnipay\EpayTests\AbstractTest;

class CompletePurchaseResponseTest extends AbstractTest
{

    public function test_can_get_response()
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
        $response = $complete->send();
        $this->assertTrue($response->isSuccessful());

        $this->assertEquals(33188791, $response->getTransactionReference());

    }

}
 