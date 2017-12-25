<?php

namespace AdjustKPIService\adapter;

use AdjustKPIService\adapter\AbstractAdapter,
    AdjustKPIService\AdjustKPIServiceException;

class CurlAdapterException extends AdjustKPIServiceException {}

/**
 * @codeCoverageIgnore
 */
class CurlAdapter extends AbstractAdapter
{
    /**
     * HTTP GET request
     */
    public function getRequest($endpoint, array $params, array $httpHeaders = [])
    {
        $endpoint .= http_build_query($params);

        $this->curlInit($endpoint);
        $this->curlSetOpt(CURLOPT_RETURNTRANSFER, true);

        if (!empty($httpHeaders)) {
            $this->curlSetOpt(CURLOPT_HTTPHEADER, $httpHeaders);
        }

        $result = $this->curlExec();
        $this->curlClose();

        return $result;
    }

    /**
     * HTTP POST request
     */
    public function postRequest($endpoint, array $params)
    {
        throw new CurlAdapterException('This Method not implemented');
    }
}

