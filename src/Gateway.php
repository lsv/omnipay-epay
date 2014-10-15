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

use Omnipay\Common\AbstractGateway;
use Omnipay\Epay\Message\Authorize\AuthorizeRequest;
use Omnipay\Epay\Message\Authorize\CompleteAuthorizeRequest;
use Omnipay\Epay\Message\Capture\CaptureRequest;
use Omnipay\Epay\Message\Purchase\PurchaseRequest;
use Omnipay\Epay\Message\Refund\RefundRequest;

/**
 * Main gateway Epay for omnipay
 */
class Gateway extends AbstractGateway
{
    /**
     * Get default parameters
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'merchantnumber' => '',
            'secret' => '',
            'language' => 0,
            'ownreceipt' => 1,
            'paymentcollection' => 0,
            'lockpaymentcollection' => 0,
            'windowstate' => 1,
            'mobile' => 1,
            'ordertext' => '',
            'group' => '',
            'description' => '',
            'googletracker' => '',
            'timeout' => ''
        );
    }

    /**
     * Set merchant number
     * @param integer $merchantNumber
     * @return $this
     */
    public function setMerchantnumber($merchantNumber)
    {
        $this->parameters->set('merchantnumber', $merchantNumber);
        return $this;
    }

    /**
     * Set md5 secret
     * @param string $secret
     * @return $this
     */
    public function setSecret($secret)
    {
        $this->parameters->set('secret', $secret);
        return $this;
    }

    /**
     * Set language
     * 0 = Auto detect
     * 1 = Danish
     * 2 = English
     * 3 = Swedish
     * 4 = Norwegian
     * 5 = Greenlandic
     * 6 = Icelandic
     * 7 = German
     * 8 = Finnish
     * 9 = Spanish
     * 10 = French
     * 11 = Polish
     * 12 = Italian
     * 13 = Dutch
     *
     * @param integer $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->parameters->set('language', (int) $language);
        return $this;
    }

    /**
     * Do you want to use your own receipt?
     * @param boolean $ownrecipt
     * @return $this
     */
    public function setOwnreceipt($ownrecipt)
    {
        $this->parameters->set('ownreceipt', (int) $ownrecipt);
        return $this;
    }

    /**
     * Sets which payment collection the user may choose from
     * 0 = Customer choice
     * 1 = Payment cards
     * 2 = Home Banking
     * 3 = Invoice
     * 4 = Mobile
     * 5 = Other
     * @param integer $collection
     * @return $this
     */
    public function setPaymentcollection($collection)
    {
        $this->setLockpaymentcollection(true);
        if ((int) $collection == 0) {
            $this->setLockpaymentcollection(false);
        }

        $this->parameters->set('paymentcollection', (int) $collection);
        return $this;
    }

    /**
     * Set locked payment collection
     * If paymentcollection is not 0, this is used to lock the payment collection.
     *
     * @param boolean $lock
     * @return $this
     */
    public function setLockpaymentcollection($lock)
    {
        $this->parameters->set('lockpaymentcollection', (int) $lock);
        return $this;
    }

    /**
     * Sets the windowstate
     * 1 = Overlay
     * 2 = iframe
     * 3 = Full screen
     * 4 = Integrated payment form
     *
     * @param integer $windowstate
     * @return $this
     */
    public function setWindowstate($windowstate)
    {
        $this->parameters->set('windowstate', (int) $windowstate);
        return $this;
    }

    /**
     * Sets mobile state
     * 0 = Disabled
     * 1 = Auto detect
     * 2 = Force mobile
     *
     * @param integer $mobile
     * @return $this
     */
    public function setMobile($mobile)
    {
        $this->parameters->set('mobile', (int) $mobile);
        return $this;
    }

    /**
     * Set order text
     * Only text is accepted. HTML will be stripped.
     *
     * @param string $text
     * @return $this
     */
    public function setOrdertext($text)
    {
        $this->parameters->set('ordertext', $text);
        return $this;
    }

    /**
     * Set payment group
     * Max. 100 characters.
     *
     * @param string $group
     * @return $this
     */
    public function setGroup($group)
    {
        $this->parameters->set('group', $group);
        return $this;
    }

    /**
     * Set order description
     * Max. 1024 characters.
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->parameters->set('description', $description);
        return $this;
    }

    /**
     * Set google tracker
     * Typically in the form UA-XXXXXXX
     *
     * @param string $tracker
     * @return $this
     */
    public function setGoogletracker($tracker)
    {
        $this->parameters->set('googletracker', $tracker);
        return $this;
    }

    /**
     * Defines a time span in which the payment can be completed.
     * The value is specified in minutes, e.g. 15 for 15 minutes.
     *
     * @param integer $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->parameters->set('timeout', (int) $timeout);
        return $this;
    }

    /**
     * Get purchase request
     * @param array $parameters
     * @return PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Epay\Message\Purchase\PurchaseRequest', $parameters);
    }

    /**
     * Get complete purchase request
     * @param array $parameters
     * @return CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Epay\Message\Purchase\CompletePurchaseRequest', $parameters);
    }

    /**
     * Get capture request
     * @param array $parameters
     * @return CaptureRequest
     */
    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Epay\Message\Capture\CaptureRequest', $parameters);
    }

    /**
     * Get refund (credit) request
     * @param array $parameters
     * @return RefundRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Epay\Message\Refund\RefundRequest', $parameters);
    }

    /**
     * Get authorize request
     * @param array $parameters
     * @return AuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Epay\Message\Authorize\AuthorizeRequest', $parameters);
    }

    /**
     * Get complete authorize request
     * @param array $parameters
     * @return CompleteAuthorizeRequest
     */
    public function completeAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Epay\Message\Authorize\CompleteAuthorizeRequest', $parameters);
    }

    /**
     * Get name of the gateway
     * @return string
     */
    public function getName()
    {
        return 'Epay';
    }
}
