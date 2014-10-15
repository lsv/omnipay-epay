<?php
namespace Omnipay\EpayTests;

use Mockery as m;
use Omnipay\Epay\Gateway;
use Omnipay\Tests\TestCase;

abstract class AbstractTest extends TestCase
{

    /**
     * @var Gateway
     */
    private $gateway;

    public function setUp()
    {
        parent::setUp();
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    protected function tearDown()
    {
        m::close();
    }

    public function getEndpointUrl()
    {
        return 'https://ssl.ditonlinebetalingssystem.dk/integration/ewindow/Default.aspx';
    }

    /**
     * @param array $data
     * @return Gateway
     */
    public function getMockedGateway(array $data)
    {
        $mock = m::mock('\Symfony\Component\HttpFoundation\Request')->makePartial();
        $mock->initialize($data);
        return new Gateway($this->getHttpClient(), $mock);
    }

    /**
     * @return Gateway
     */
    public function getGateway()
    {
        return $this->gateway;
    }

    /**
     * @return array
     */
    public function getDataArray()
    {
        return [
            'amount' => 100,
            'currency' => 'DKK',
            'returnUrl' => 'localhost'
        ];
    }

    public function getDataWithHash()
    {
        return [
            'orderid' => 'b98914102014160534',
            'amount' => 20,
            'currency' => 'DKK',
            'returnUrl' => 'localhost',
            'secret' => 'alphabetacharlie'
        ];
    }

    public function getMercahtNumber()
    {
        return 123;
    }

}
 