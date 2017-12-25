<?php

namespace AdjustKPIService;

use AdjustKPIService\AdjustKPIServiceException;

class ResponseFormatterException extends AdjustKPIServiceException {}

class ResponseFormatter
{
    const RESPONSE_TYPE_JSON = 'json';
    const RESPONSE_TYPE_CSV  = 'csv';

    protected $_acceptHeader,
              $_formatFunc,
              $_availableResponseFormats = [
                  'json', 'csv',
              ];

    public function __construct($response_type = null)
    {
        if (empty($response_type)) {
            $response_type = static::RESPONSE_TYPE_JSON;
        } else if (!in_array($response_type, $this->_availableResponseFormats)) {
            throw new ResponseFormatterException('Not supported response format - ' . $response_type);
        }

        switch ($response_type) {
            case static::RESPONSE_TYPE_CSV:
                $this->_acceptHeader = 'Accept: text/csv';
                $this->_formatFunc = 'formatAsCSV';
                break;
            default:
                $this->_acceptHeader = 'Accept: application/json';
                $this->_formatFunc = 'formatAsJSON';
                break;
        }
    }

    public function getAcceptHeader()
    {
        return $this->_acceptHeader;
    }

    public function formatResponse($response)
    {
        return call_user_func([$this, $this->_formatFunc], $response);
    }

    protected function formatAsJSON($response)
    {
        return json_decode($response, 1);
    }

    protected function formatAsCSV($response)
    {
        throw new ResponseFormatterException('CSV response formatting not implemented');
    }
}

