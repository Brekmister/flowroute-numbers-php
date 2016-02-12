<?php
/*
 * FlowrouteNumbersLib
 *
 * This file was automatically generated for flowroute by APIMATIC BETA v2.0 on 02/12/2016
 */

namespace FlowrouteNumbersLib;

use Exception;

class APIException extends Exception {
    //private value store
    private $responseCode;
    private $responseBody;
    
    /*
     * The HTTP response code from the API request
     * @param string $reason the reason for raising an exception
     * @param int $responseCode the HTTP response code from the API request
     */
    public function __construct($reason, $responseCode, $responseBody)
    {
        parent::__construct($reason, $responseCode, NULL);
        $this->responseCode = $responseCode;
        $this->responseBody = $responseBody;
    }

    /*
     * The HTTP response code from the API request
     * @return int
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /*
     * The HTTP response body from the API request
     * @return mixed
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /*
     * The reason for raising an exception
     * @return string
     */
    public function getReason()
    {
        return $this->message;
    }
}