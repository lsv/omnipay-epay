<?php
/**
 * This file is part of the Epay for Omnipay package.
 *
 * (c) Martin Aarhof <martin.aarhof@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Omnipay\Epay\Message\Purchase;

use Omnipay\Common\Exception\InvalidResponseException;

/**
 * Epay complete purchase request
 */
class CompletePurchaseRequest extends PurchaseRequest
{
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return array
     * @throws InvalidResponseException
     */
    public function getData()
    {
        if (!$this->verifyHash($this->httpRequest->query->all())) {
            throw new InvalidResponseException('Hash is invalid');
        }

        return $this->httpRequest->query->all();
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed             $data The data to send
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }

    /**
     * Send the request
     *
     * @return CompletePurchaseResponse
     */
    public function send()
    {
        return $this->sendData($this->getData());
    }
}
