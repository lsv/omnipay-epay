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
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Epay\Settings;

/**
 * Epay purchase response
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * Does the response require a redirect?
     *
     * @return boolean
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * Gets the redirect target url.
     * @return string
     */
    public function getRedirectUrl()
    {
        return Settings::getEndpoint() . '?' . http_build_query($this->getData());
    }

    /**
     * Get the required redirect method (either GET or POST).
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * Gets the redirect form data array, if the redirect method is POST.
     * @return array
     */
    public function getRedirectData()
    {
        return $this->getData();
    }
}
