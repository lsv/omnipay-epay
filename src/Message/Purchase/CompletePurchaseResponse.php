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

use Omnipay\Common\Message\AbstractResponse;

/**
 * Epay complete purchase response
 */
class CompletePurchaseResponse extends AbstractResponse
{

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return true;
    }

    /**
     * Gateway Reference
     *
     * @return string A reference provided by the gateway to represent this transaction
     */
    public function getTransactionReference()
    {
        return isset($this->data['txnid']) ? $this->data['txnid'] : null;
    }
}
