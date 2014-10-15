<?php
/**
 * This file is part of the Epay for Omnipay package.
 *
 * (c) Martin Aarhof <martin.aarhof@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Omnipay\Epay\Message\Authorize;

use Omnipay\Epay\Message\Purchase\PurchaseRequest;

/**
 * Epay authorize request
 */
class AuthorizeRequest extends PurchaseRequest
{

    /**
     * Initialize the object with parameters.
     *
     * If any unknown parameters passed, they will be ignored.
     *
     * @param array $parameters An associative array of parameters
     *
     * @return AuthorizeRequest
     * @throws RuntimeException
     */
    public function initialize(array $parameters = array())
    {
        return $this->init($parameters, 0);
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return AuthorizeResponse
     */
    public function sendData($data)
    {
        return $this->response = new AuthorizeResponse($this, $data);
    }
}
