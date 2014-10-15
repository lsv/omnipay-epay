<?php
namespace Omnipay\EpayTests;

use Omnipay\Epay\Message\Authorize\AuthorizeRequest;

class RequestTest extends AbstractTest
{

    /**
     * @var AuthorizeRequest
     */
    private $g;

    public function setUp()
    {
        parent::setUp();
        $this->g = $this->getGateway()
            ->setMerchantnumber($this->getMercahtNumber())
            ->authorize($this->getDataArray())
        ;
    }

    public function dataProvider()
    {
        return [
            ['setNotifyUrl', 'notifyUrl', 'getNotifyUrl'],
            ['setCard', 'card', 'getCard'],
            ['setIssuer', 'issuer', 'getIssuer'],
            ['setClientIp', 'clientip', 'getClientIp'],
            ['setDescription', 'description', 'getDescription'],
            ['setTransactionId', 'transactionid', 'getTransactionId'],
            ['setTransactionReference', 'transactionreference', 'getTransactionReference'],
            ['setCardReference', 'cardreference', 'getCardReference'],
        ];
    }

    /**
     * @dataProvider dataProvider
     *
     * @param string $setter
     * @param string $value
     * @param string $getter
     */
    public function test_can_not_set($setter, $value, $getter)
    {
        $this->g->{$setter}('data');
        $this->assertArrayNotHasKey($value, $this->g->getData());
        $this->assertEquals(null, $this->g->{$getter}());
    }

    public function test_can_set_returnurl()
    {
        $this->g->setReturnUrl('123');
        $this->assertArrayHasKey('callbackurl', $this->g->getData());
        $this->assertEquals('123', $this->g->getReturnUrl());
    }

    public function test_can_set_cancelurl()
    {
        $this->g->setCancelUrl('123');
        $this->assertArrayHasKey('cancelurl', $this->g->getData());
        $this->assertEquals('123', $this->g->getCancelUrl());
    }

    public function test_get_runtime_exeption_if_response_is_not_null()
    {
        $gateway = $this->getMockedGateway(array('foo' => 1));
        $request = $gateway
            ->setMerchantnumber($this->getMercahtNumber())
            ->authorize($this->getDataArray())
        ;
    }

}
 