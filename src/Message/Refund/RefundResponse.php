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

use Omnipay\Common\Message\AbstractResponse;

/**
 * Epay refund response
 */
class RefundResponse extends AbstractResponse
{

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        $data = $this->getData();
        return isset($data['creditResult']) && $data['creditResult'];
    }
}
