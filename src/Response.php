<?php

namespace Rhinodontypicus\LetsAds;

use ErrorException;
use SimpleXMLElement;

class Response
{
    /**
     * Errors.
     */
    protected static $errors = [
        'NO_DATA' => 'Data error: xml not sent',
        'WRONG_DATA_FORMAT' => 'Wrong xml format',
        'REQUEST_FORMAT' => 'Wrong request format',
        'AUTH_DATA' => 'Wrong auth data',
        'API_DISABLED' => 'Api disabled',
        'UNKNOWN_ERROR' => 'Unknown error',
        'MESSAGE_NOT_EXIST' => 'Message does not exists',
        'USER_NOT_MODERATED' => 'User not moderated',
        'INCORRECT_FROM' => 'Incorrect sender name',
        'INCORRECT_RECIPIENT' => 'Incorrect recipient phone',
        'INVALID_FROM' => 'Sender name does not exists',
        'MESSAGE_TOO_LONG' => 'Too long message (201 cyr, 459 lat)',
        'NO_MESSAGE' => 'No message provided',
        'MAX_MESSAGES_COUNT' => 'Too many messages in one request',
        'NOT_ENOUGH_MONEY' => 'Not enough money',
    ];

    /**
     * @param string $xmlString
     * @return ErrorException|SimpleXMLElement
     */
    public static function get($xmlString)
    {
        $simpleXml = new SimpleXMLElement($xmlString);

        if (self::isErrorXml($simpleXml)) {
            return new ErrorException(self::getErrorMessage($simpleXml));
        }

        return $simpleXml;
    }

    /**
     * @param SimpleXMLElement $xmlElement
     * @return bool
     */
    public static function isErrorXml(SimpleXMLElement $xmlElement)
    {
        if ($xmlElement->name == 'Error') {
            return true;
        }

        return false;
    }

    /**
     * @param SimpleXMLElement $xmlElement
     * @return string
     */
    public static function getErrorMessage(SimpleXMLElement $xmlElement)
    {
        $error = 'Unknown Error';
        foreach (self::$errors as $key => $value) {
            if (strpos($xmlElement->description->__toString(), $key) !== false) {
                $error = $value;
            }
        }

        return $error;
    }
}
