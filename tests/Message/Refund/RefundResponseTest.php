<?php
namespace Omnipay\EpayTests\Message\Refund;

use Omnipay\EpayTests\AbstractTest;
use Omnipay\EpayTests\Callbacks\refundCallback;

class RefundResponseTest extends AbstractTest
{

    /**
     * @return captureCallback
     */
    public function clientCallback()
    {
        return new refundCallback();
    }

    public function test_can_create_response()
    {
        $stub = $this->getMock(
            'Omnipay\Epay\SoapClient', array('getClient')
        );
        $stub->expects($this->any())
            ->method('getClient')
            ->will($this->returnCallback(array($this, 'clientCallback')))
        ;
        $this->assertInstanceOf('\Omnipay\EpayTests\Callbacks\refundCallback', $stub->getClient());

        $request = $this->getGateway()
            ->setMerchantnumber(123)
            ->refund($this->getDataArray())
            ->setTransactionId('123')
        ;

        $request->setClient($stub);
        $response = $request->send();

        $this->assertTrue($response->isSuccessful());

    }

}
 