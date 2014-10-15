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

use Omnipay\Epay\Message\AbstractRequest;

/**
 * Epay purchase request
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * Initialize request with parameters
     *
     * @param array $parameters
     * @throws \Omnipay\Epay\Message\RuntimeException
     * @return $this
     */
    public function initialize(array $parameters = array())
    {
        return $this->init($parameters, 1);
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return array
     */
    public function getData()
    {
        if ($this->parameters->has('callbackurl') && !$this->parameters->has('accepturl')) {
            $this->parameters->set('accepturl', $this->parameters->get('callbackurl'));
        }

        $this->validate('merchantnumber', 'currency', 'accepturl', 'amount');
        $this->setHash($this->parameters);
        return $this->parameters->all();
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed             $data The data to send
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

    /**
     * Send the request
     *
     * @return PurchaseResponse
     */
    public function send()
    {
        return $this->sendData($this->getData());
    }
}
