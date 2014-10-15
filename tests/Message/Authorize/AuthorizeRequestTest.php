<?php
namespace Omnipay\EpayTests\Message\Authorize;

use Omnipay\EpayTests\AbstractTest;

class AuthorizeRequestTest extends AbstractTest
{

    public function test_can_authorize()
    {
        $gateway = $this->getGateway()
            ->setMerchantnumber($this->getMercahtNumber())
            ->authorize($this->getDataArray())
        ;

        $this->assertInstanceOf('Omnipay\Epay\Message\Authorize\AuthorizeRequest', $gateway);
    }

}
 