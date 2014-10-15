<?php
namespace Omnipay\EpayTests\Message\Refund;

use Omnipay\EpayTests\AbstractTest;

class RefundRequestTest extends AbstractTest
{

    public function test_can_get_refund()
    {
        $request = $this->getGateway()
            ->setMerchantnumber(123)
            ->refund($this->getDataArray())
        ;
        $this->assertInstanceOf('Omnipay\Epay\Message\Refund\RefundRequest', $request);
    }

    public function test_throws_error_if_client_not_set()
    {
        $this->setExpectedException('InvalidArgumentException', 'You need to call "setClient" before "send"');

        $request = $this->getGateway()
            ->setMerchantnumber(123)
            ->refund($this->getDataArray())
        ;
        $request->setTransactionId(123);
        $request->send();
    }

}
 