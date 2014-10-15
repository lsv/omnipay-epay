<?php
/**
 * This file is part of the Epay for Omnipay package.
 *
 * (c) Martin Aarhof <martin.aarhof@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Omnipay\Epay\Message\Capture;

use Omnipay\Epay\SoapClient;
use Omnipay\Epay\Settings;
use Omnipay\Epay\Message\Purchase\PurchaseRequest;

/**
 * Epay capture request
 */
class CaptureRequest extends PurchaseRequest
{

    /**
     * Soap client
     * @var SoapClient
     */
    private $client;

    /**
     * Set the soap client
     * @param SoapClient $client
     * @return $this
     */
    public function setClient(SoapClient $client)
    {
        $this->client = $client->getClient();
        return $this;
    }

    /**
     * Set the transaction id
     * @param string $value
     * @return $this
     */
    public function setTransactionId($value)
    {
        return $this->setParameter('transactionid', $value);
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('merchantnumber', 'amount', 'transactionid');

        $data = array();
        foreach (Settings::getCaptureKeys() as $key) {
            $value = $this->parameters->get($key);
            if (!empty($value)) {
                $data[$key] = $value;
            }
        }

        /** Hack from SOAP description */
        $data['pbsResponse'] = -1;
        $data['epayresponse'] = -1;

        return $data;
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed             $data The data to send
     * @return CaptureResponse
     */
    public function sendData($data)
    {
        if (! $this->client) {
            throw new \InvalidArgumentException('You need to call "setClient" before "send"');
        }

        $result = $this->client->capture($data);
        return $this->response = new CaptureResponse($this, array(
            'captureResult' => $result->captureResult,
            'pbsResponse' => $result->pbsResponse,
            'epayresponse' => $result->epayresponse,
        ));
    }

    /**
     * Send the request
     *
     * @return CaptureResponse
     */
    public function send()
    {
        return $this->sendData($this->getData());
    }
}
