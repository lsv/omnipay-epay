<?php
namespace Omnipay\EpayTests\Message\Capture;

use Omnipay\EpayTests\AbstractTest;
use Omnipay\EpayTests\Callbacks\captureCallback;

class CaptureResponseTest extends AbstractTest
{

    /**
     * @return captureCallback
     */
    public function clientCallback()
    {
        return new captureCallback();
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
        $this->assertInstanceOf('\Omnipay\EpayTests\Callbacks\captureCallback', $stub->getClient());

        $request = $this->getGateway()
            ->setMerchantnumber(123)
            ->capture($this->getDataArray())
            ->setTransactionId('123')
        ;

        $request->setClient($stub);
        $response = $request->send();

        $this->assertTrue($response->isSuccessful());

    }

}
 