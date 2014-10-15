<?php
namespace Omnipay\EpayTests;

class GatewayTest extends AbstractTest
{

    public function test_can_get_name()
    {
        $this->assertEquals('Epay', $this->getGateway()->getName());
    }

    public function test_getDefaultParameters()
    {
        $this->assertArrayHasKey('merchantnumber', $this->getGateway()->getParameters());
    }

    public function test_can_set_parameters()
    {
        $this->getGateway()
            ->setMerchantnumber(123)
            ->setSecret('secret')
            ->setLanguage(1)
            ->setOwnreceipt(false)
            ->setPaymentcollection(0)
            ->setLockpaymentcollection(false)
            ->setWindowstate(1)
            ->setMobile(0)
            ->setOrdertext('order text')
            ->setGroup('group')
            ->setDescription('Description')
            ->setGoogletracker('UA-xxxxx')
            ->setTimeout(15)
        ;

        $this->assertArrayHasKey('merchantnumber', $this->getGateway()->getParameters());
        $this->assertArrayHasKey('secret', $this->getGateway()->getParameters());
        $this->assertArrayHasKey('language', $this->getGateway()->getParameters());
        $this->assertArrayHasKey('ownreceipt', $this->getGateway()->getParameters());
        $this->assertArrayHasKey('paymentcollection', $this->getGateway()->getParameters());
        $this->assertArrayHasKey('lockpaymentcollection', $this->getGateway()->getParameters());
        $this->assertArrayHasKey('windowstate', $this->getGateway()->getParameters());
        $this->assertArrayHasKey('mobile', $this->getGateway()->getParameters());
        $this->assertArrayHasKey('ordertext', $this->getGateway()->getParameters());
        $this->assertArrayHasKey('group', $this->getGateway()->getParameters());
        $this->assertArrayHasKey('description', $this->getGateway()->getParameters());
        $this->assertArrayHasKey('googletracker', $this->getGateway()->getParameters());
        $this->assertArrayHasKey('timeout', $this->getGateway()->getParameters());

    }

    public function test_set_lockedpayment_when_paymentcollection_isset()
    {
        $this->getGateway()->setPaymentcollection(1);

        $params = $this->getGateway()->getParameters();
        $this->assertEquals(1, $params['lockpaymentcollection']);

        $this->getGateway()->setPaymentcollection(0);

        $params = $this->getGateway()->getParameters();
        $this->assertEquals(0, $params['lockpaymentcollection']);
    }

}
 