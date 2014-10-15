<?php
/**
 * This file is part of the Epay for Omnipay package.
 *
 * (c) Martin Aarhof <martin.aarhof@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Omnipay\Epay;

/**
 * Epay soap client
 */
class SoapClient
{

    /**
     * Get soap client
     * @return \SoapClient
     */
    public function getClient()
    {
        return new \SoapClient(Settings::getWsdlEndpoint());
    }
}
