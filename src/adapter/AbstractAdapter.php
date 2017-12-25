<?php

namespace AdjustKPIService\adapter;

/**
 * @codeCoverageIgnore
 */
abstract class AbstractAdapter
{
    abstract public function postRequest($endpoint, array $params);
    abstract public function getRequest($endpoint, array $params);

    protected $ch;

    protected function curlInit($endpoint)
    {
        $this->ch = curl_init($endpoint);
    }

    protected function curlSetOpt($opt, $values)
    {
        return curl_setopt($this->ch, $opt, $values);
    }

    protected function curlExec()
    {
        return curl_exec($this->ch);
    }

    protected function curlClose()
    {
        return curl_close($this->ch);
    }
}

