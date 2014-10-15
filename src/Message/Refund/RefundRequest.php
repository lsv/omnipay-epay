<?php
/**
 * This file is part of the Epay for Omnipay package.
 *
 * (c) Martin Aarhof <martin.aarhof@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Omnipay\Epay\Message\Refund;

use Omnipay\Epay\Settings;
use Omnipay\Epay\Message\Capture\CaptureRequest;
use Omnipay\Epay\SoapClient;

/**
 * Epay refund request
 */
class RefundRequest extends CaptureRequest
{

    /**
     * Soap client
     * @var SoapClient
     */
    private $client;

    /**
     * Set soap client
     * @param SoapClient $client
     * @return $this
     */
    public function setClient(SoapClient $client)
    {
        $this->client = $client->getClient();
        return $this;
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
     * @return RefundResponse
     * @throws \InvalidArgumentException
     */
    public function sendData($data)
    {
        if (! $this->client) {
            throw new \InvalidArgumentException('You need to call "setClient" before "send"');
        }

        $result = $this->client->credit($data);
        return $this->response = new RefundResponse($this, [
            'creditResult' => $result->creditResult,
            'pbsResponse' => $result->pbsresponse,
            'epayresponse' => $result->epayresponse,
        ]);
    }
}
