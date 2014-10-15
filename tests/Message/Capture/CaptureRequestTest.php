<?php
namespace Omnipay\EpayTests\Message\Capture;

use Omnipay\Epay\SoapClient;
use Omnipay\EpayTests\AbstractTest;

class CaptureRequestTest extends AbstractTest
{

    public function test_can_get_capture()
    {
        $request = $this->getGateway()
            ->setMerchantnumber(123)
            ->capture($this->getDataArray())
        ;
        $this->assertInstanceOf('Omnipay\Epay\Message\Capture\CaptureRequest', $request);

        $request->setTransactionId(123);
        $request->setClient(new SoapClient());

        $this->assertArrayHasKey('merchantnumber', $request->getData());
        $this->assertArrayHasKey('amount', $request->getData());
        $this->assertArrayHasKey('transactionid', $request->getData());

        $response = $request->send();
        $this->assertInstanceOf('Omnipay\Epay\Message\Capture\CaptureResponse', $response);

    }

    public function test_throws_error_if_client_not_set()
    {
        $this->setExpectedException('InvalidArgumentException', 'You need to call "setClient" before "send"');

        $request = $this->getGateway()
            ->setMerchantnumber(123)
            ->capture($this->getDataArray())
        ;
        $request->setTransactionId(123);
        $response = $request->send();
    }

}
 