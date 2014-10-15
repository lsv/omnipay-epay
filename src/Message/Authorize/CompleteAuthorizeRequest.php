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

use Omnipay\Epay\Message\Purchase\CompletePurchaseRequest;

/**
 * Epay complete authorize request
 */
class CompleteAuthorizeRequest extends CompletePurchaseRequest
{

    /**
     * Send the request with specified data
     *
     * @param  mixed             $data The data to send
     * @return CompleteAuthorizeResponse
     */
    public function sendData($data)
    {
        return $this->response = new CompleteAuthorizeResponse($this, $data);
    }
}
