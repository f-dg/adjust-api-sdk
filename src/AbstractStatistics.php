<?php

namespace AdjustKPIService;

use AdjustKPIService\AdjustKPIServiceException,
    AdjustKPIService\ResponseFormatter,
    AdjustKPIService\adapter\AbstractAdapter;

class AbstractStatisticsException extends AdjustKPIServiceException {}

abstract class AbstractStatistics
{
    const ENDPOINT = '';
    const DEFAULT_ENDPOINT = 'https://api.adjust.com/kpis/';
    const DEFAULT_ENDPOINT_VERSION = 'v1';

    protected $_endpoint, 
              $_adapter,
              $_responseFormatter,
              $_apiConfig = [];

    public function __construct(AbstractAdapter $adapter, array $apiConfig)
    {
        $this->_adapter = $adapter;

        if (empty($apiConfig['user_token'])) {
            throw new AbstractStatisticsException('User Token is required');
        }

        if (empty($apiConfig['app_token'])) {
            throw new AbstractStatisticsException('App Token is required');
        }

        if (empty($apiConfig['endpoint'])) {
            $apiConfig['endpoint'] = static::DEFAULT_ENDPOINT;
        }

        if (empty($apiConfig['endpoint_version'])) {
            $apiConfig['endpoint_version'] = static::DEFAULT_ENDPOINT_VERSION;
        }

        $this->_responseFormatter = $this->getResponseFormatter($apiConfig);
        $this->_apiConfig = $apiConfig;
    }

    protected function getResponseFormatter(array $apiConfig)
    {
        $response_type = isset($apiConfig['response_type']) 
            ? $apiConfig['response_type'] 
            : null; 
        return new ResponseFormatter($response_type);
    }

    public function getData(array $params)
    {
        $httpHeaders = [
            $this->getAcceptHeader(),
            $this->getAuthorizationHeader(),
        ];
        $response = $this->fetch($params, $httpHeaders);
        return $this->_responseFormatter->formatResponse($response);
    }

    protected function getAcceptHeader()
    {
        return $this->_responseFormatter->getAcceptHeader();
    }

    protected function getAuthorizationHeader()
    {
        return 'Authorization: Token token=' . $this->_apiConfig['user_token'];
    }

    protected function fetch(array $params, array $httpHeaders)
    {
        $this->makeEndpoint();

        $result = $this->_adapter->getRequest(
            $this->_endpoint, 
            $params,
            $httpHeaders
        );
        return $result;
    }

    protected function makeEndpoint()
    {
        $this->_endpoint = $this->_apiConfig['endpoint'] 
            . $this->_apiConfig['endpoint_version'] 
            . '/'
            . $this->_apiConfig['app_token'] 
            . (
                empty($this->_apiConfig['tracker_token'])
                    ? ''
                    : '/trackers/' . $this->_apiConfig['tracker_token']
              )
            . static::ENDPOINT
            . '?';

        if (!filter_var($this->_endpoint, FILTER_VALIDATE_URL)) {
            throw new AbstractStatisticsException(
                'Invalid api endpoint - ' . $this->_endpoint
            );
        }
    }
}

