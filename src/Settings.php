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
 * Epay static settings
 */
class Settings
{

    /**
     * Url to payment window
     */
    const WINDOW_URL = 'https://ssl.ditonlinebetalingssystem.dk/integration/ewindow/Default.aspx';

    /**
     * Url to api endpoint
     */
    const REMOTE_URL = 'https://ssl.ditonlinebetalingssystem.dk/remote/payment.asmx';

    /**
     * Get all valid keys
     * @return array
     */
    public static function getKeys()
    {
        return [
            'merchantnumber', 'currency','amount', 'secret', 'orderid',
            'windowstate', 'mobile', 'windowid', 'paymentcollection',
            'lockpaymentcollection', 'paymenttype', 'language', 'encoding',
            'cssurl', 'mobilecssurl', 'instantcapture', 'splitpayment',
            'instantcallback', 'callbackurl', 'accepturl', 'cancelurl', 'ownreceipt',
            'ordertext', 'group', 'description', 'subscription', 'subscriptionname',
            'mailreceipt', 'googletracker', 'backgroundcolor', 'opacity', 'declinetext',
            'iframeheight', 'iframewidth', 'timeout'
        ];
    }

    /**
     * Get valid capture keys
     * @return array
     */
    public static function getCaptureKeys()
    {
        return ['merchantnumber', 'amount', 'transactionid', 'group'];
    }

    /**
     * Get WSDL endpoint
     * @return string
     */
    public static function getWsdlEndpoint()
    {
        return self::REMOTE_URL . '?WSDL';
    }

    /**
     * Get window endpoint
     * @return string
     */
    public static function getEndpoint()
    {
        return self::WINDOW_URL;
    }
}
