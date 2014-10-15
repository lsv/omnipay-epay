<?php
/**
 * This file is part of the Epay for Omnipay package.
 *
 * (c) Martin Aarhof <martin.aarhof@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Omnipay\Epay\Message;

use Omnipay\Common\Helper;
use Omnipay\Common\Message\AbstractRequest as AbstractBaseRequest;
use Omnipay\Epay\Settings;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Epay abstract request
 */
abstract class AbstractRequest extends AbstractBaseRequest
{

    /**
     * Build parameters to request
     * @param array $parameters
     * @param int $instantCapture
     * @return $this
     * @throws RuntimeException
     */
    protected function init(array $parameters, $instantCapture = 0)
    {
        if (null !== $this->response) {
            throw new RuntimeException('Request cannot be modified after it has been sent!');
        }

        $this->addParameters($parameters);
        $this->parameters->set('instantcapture', $instantCapture);

        return $this;
    }

    /**
     * Add the parameters to the bag
     * @param array $parameters
     */
    private function addParameters(array $parameters)
    {
        $this->parameters = new ParameterBag();
        $supportedKeys = Settings::getKeys();
        if (is_array($parameters)) {
            foreach ($parameters as $key => $value) {
                $method = 'set' . ucfirst(Helper::camelCase($key));
                if (method_exists($this, $method)) {
                    $this->$method($value);
                } elseif (in_array($key, $supportedKeys)) {
                    $this->parameters->set($key, $value);
                }
            }
        }
    }

    /**
     * Hash the parameters
     * @param ParameterBag $parameters
     */
    public function setHash(ParameterBag &$parameters)
    {
        if ($parameters->has('secret')) {
            $secret = $this->parameters->get('secret');
            $this->parameters->remove('secret');

            $hash = md5(implode('', array_values($this->parameters->all())) . $secret);
            $this->parameters->set('hash', $hash);
        }
    }

    /**
     * Verify response hash
     * @param array $data
     * @return bool
     */
    public function verifyHash(array $data)
    {
        $hash = '';
        if (isset($data['hash']) && $this->parameters->has('secret')) {
            foreach ($data as $key => $value) {
                if ($key === 'hash') {
                    continue;
                }
                $hash .= $value;
            }

            return md5($hash . $this->parameters->get('secret')) == $data['hash'];

        }

        return true;
    }

    /**
     * Get the return url
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->getParameter('callbackurl');
    }

    /**
     * Set the return url
     * @param string $value
     * @return AbstractBaseRequest
     */
    public function setReturnUrl($value)
    {
        return $this->setParameter('callbackurl', $value);
    }

    /**
     * Get the cancel url
     * @return string
     */
    public function getCancelUrl()
    {
        return $this->getParameter('cancelurl');
    }

    /**
     * Set the cancel url
     * @param string $value
     * @return AbstractBaseRequest
     */
    public function setCancelUrl($value)
    {
        return $this->setParameter('cancelurl', $value);
    }

    /**
     * Notify url can not be set
     * @return void
     */
    public function getNotifyUrl()
    {
    }

    /**
     * Can not set notify url
     * @return void
     */
    public function setNotifyUrl()
    {
    }

    /**
     * Can not get card
     * @return void
     */
    public function getCard()
    {
    }

    /**
     * Can not set card
     * @return void
     */
    public function setCard()
    {
    }

    /**
     * Can not get issuer
     * @return void
     */
    public function getIssuer()
    {
    }

    /**
     * Can not set issuer
     * @return void
     */
    public function setIssuer()
    {
    }

    /**
     * Can not get client ip
     * @return void
     */
    public function getClientIp()
    {
    }

    /**
     * Can not set client ip
     * @return void
     */
    public function setClientIp()
    {
    }

    /**
     * Can not get description
     * @return void
     */
    public function getDescription()
    {
    }

    /**
     * Can not set description
     * @return void
     */
    public function setDescription()
    {
    }

    /**
     * Can not get transaction id
     * @return void
     */
    public function getTransactionId()
    {
    }

    /**
     * Can not set transaction id
     * @return void
     */
    public function setTransactionId()
    {
    }

    /**
     * Can not get transaction reference
     * @return void
     */
    public function getTransactionReference()
    {
    }

    /**
     * Can not set transaction reference
     * @return void
     */
    public function setTransactionReference()
    {
    }

    /**
     * Can not get card reference
     * @return void
     */
    public function getCardReference()
    {
    }

    /**
     * Can not set card reference
     * @return void
     */
    public function setCardReference()
    {
    }
}
