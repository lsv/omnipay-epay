<?php
namespace Omnipay\EpayTests\Message\Purchase;

use Omnipay\Epay\Message\Purchase\CompletePurchaseRequest;
use Omnipay\EpayTests\AbstractTest;

class PurchaseRequestTest extends AbstractTest
{

    public function test_can_request()
    {
        $gateway = $this->getGateway()
            ->setMerchantnumber($this->getMercahtNumber())
            ->purchase($this->getDataArray())
        ;

        $this->assertInstanceOf('Omnipay\Epay\Message\Purchase\PurchaseRequest', $gateway);

        $response = $gateway->send();
        $this->assertInstanceOf('Omnipay\Epay\Message\Purchase\PurchaseResponse', $response);
        $this->assertArrayHasKey('accepturl', $response->getData());
        $this->assertArrayHasKey('amount', $response->getData());
        $this->assertArrayHasKey('currency', $response->getData());

    }

}
 