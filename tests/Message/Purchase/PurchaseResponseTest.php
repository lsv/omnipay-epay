<?php
namespace Omnipay\EpayTests\Message\Purchase;

use Omnipay\EpayTests\AbstractTest;

class PurchaseResponseTest extends AbstractTest
{

    public function test_can_create_response()
    {
        $gateway = $this->getGateway()
            ->setMerchantnumber($this->getMercahtNumber())
            ->purchase($this->getDataArray())
        ;

        $response = $gateway->send();
        $this->assertInstanceOf('Omnipay\Epay\Message\Purchase\PurchaseResponse', $response);

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('GET', $response->getRedirectMethod());

        $this->assertArrayHasKey('instantcapture', $response->getRedirectData());
        $this->assertArrayHasKey('amount', $response->getRedirectData());
        $this->assertArrayHasKey('currency', $response->getRedirectData());

        $this->assertEquals($this->getEndpointUrl() . '?' . http_build_query($response->getRedirectData()), $response->getRedirectUrl());

    }

}
 