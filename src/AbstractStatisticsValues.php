<?php

namespace AdjustKPIService;

abstract class AbstractStatisticsValues
{
    const RESPONSE_FIELD_KPIS_VALUES = 'kpi_values';
    const RESPONSE_FIELD_ENTITY_NAME = 'name';
    const RESPONSE_FIELD_DATE = 'date';
    const RESPONSE_FIELD_DATES = 'dates';
    const RESPONSE_FIELD_RESULT_PARAM = 'result_parameters';
    const RESPONSE_FIELD_RESULT_SET = 'result_set';
    const RESPONSE_FIELD_CURRENCY = 'currency';
    const RESPONSE_FIELD_TOKEN = 'token';

    const EVENT_KPIS_VALUE_REVENUE_EVENTS            = 'revenue_events';
    const EVENT_KPIS_VALUE_REVENUE                   = 'revenue';
    const EVENT_KPIS_VALUE_EVENTS                    = 'events';
    const EVENT_KPIS_VALUE_FIRST_EVENTS              = 'first_events';
    const EVENT_KPIS_VALUE_REVENUE_PER_EVENT         = 'revenue_per_event';
    const EVENT_KPIS_VALUE_REVENUE_PER_REVENUE_EVENT = 'revenue_per_revenue_event';

    const REQUEST_PARAM_UTC_OFFSET           = 'utc_offset';
    const REQUEST_PARAM_START_DAY            = 'start_date';
    const REQUEST_PARAM_END_DAY              = 'end_date';
    const REQUEST_PARAM_KPIS                 = 'kpis';
    const REQUEST_PARAM_EVENT_KPIS           = 'event_kpis';
    const REQUEST_PARAM_SANDBOX              = 'sandbox';
    const REQUEST_PARAM_IMPRESSION_BASED     = 'impression_based';
    const REQUEST_PARAM_COUNTRIES            = 'countries';
    const REQUEST_PARAM_OS_NAMES             = 'os_names';
    const REQUEST_PARAM_DEVICE_TYPES         = 'device_types';
    const REQUEST_PARAM_GROUPING             = 'grouping';
    const REQUEST_PARAM_HUMAN_READABLE_KIPIS = 'human_readable_kpis';
    const REQUEST_PARAM_ATTRIBUTION_TYPE     = 'attribution_type';
    const REQUEST_PARAM_CONVERSION_TYPE      = 'conversion_type';

    const REQUEST_VALUE_GROUPING_TRACKER = 'trackers';
    const REQUEST_VALUE_GROUPING_COUNTRIES = 'countries';
    const REQUEST_VALUE_GROUPING_REGION = 'region';
    const REQUEST_VALUE_GROUPING_DEVICE_TYPES = 'device_types';
    const REQUEST_VALUE_GROUPING_OS_NAMES = 'os_names';
    const REQUEST_VALUE_GROUPING_HOUR = 'hour';
    const REQUEST_VALUE_GROUPING_DAY = 'day';
    const REQUEST_VALUE_GROUPING_WEEK = 'week';
    const REQUEST_VALUE_GROUPING_MONTH = 'month';
    const REQUEST_VALUE_GROUPING_CAMPAIGNS = 'campaigns';
    const REQUEST_VALUE_GROUPING_ADGROUPS = 'adgroups';
    const REQUEST_VALUE_GROUPING_CREATIVES = 'creatives';

    const REQUEST_VALUE_OS_NAMES_ANDROID = 'android';
    const REQUEST_VALUE_OS_NAMES_BADA = 'bada';
    const REQUEST_VALUE_OS_NAMES_BLACKBERRY = 'blackberry';
    const REQUEST_VALUE_OS_NAMES_IOS = 'ios';
    const REQUEST_VALUE_OS_NAMES_LINUX = 'linux';
    const REQUEST_VALUE_OS_NAMES_MACOS = 'macos';
    const REQUEST_VALUE_OS_NAMES_SERVER = 'server';
    const REQUEST_VALUE_OS_NAMES_SYMBIAN = 'symbian';
    const REQUEST_VALUE_OS_NAMES_UNKNOWN = 'unknown';
    const REQUEST_VALUE_OS_NAMES_WEBOS = 'webos';
    const REQUEST_VALUE_OS_NAMES_WINDOWS = 'windows';
    const REQUEST_VALUE_OS_NAMES_WINDOWS_PHONE = 'windows-phone';

    const REQUEST_VALUE_DEVICE_TYPE_BOT = 'bot';
    const REQUEST_VALUE_DEVICE_TYPE_CONSOLE = 'console';
    const REQUEST_VALUE_DEVICE_TYPE_IPOD = 'ipod';
    const REQUEST_VALUE_DEVICE_TYPE_MAC = 'mac';
    const REQUEST_VALUE_DEVICE_TYPE_PC = 'pc';
    const REQUEST_VALUE_DEVICE_TYPE_PHONE = 'phone';
    const REQUEST_VALUE_DEVICE_TYPE_SERVER = 'server';
    const REQUEST_VALUE_DEVICE_TYPE_SIMULATOR = 'simulator';
    const REQUEST_VALUE_DEVICE_TYPE_TABLET = 'tablet';
    const REQUEST_VALUE_DEVICE_TYPE_UNKNOWN = 'unknown';

    protected static $formatRequestedDate = 'Y-m-d';

    public function formatRequestDate($timestamp)
    {
        return date(static::$formatRequestedDate, $timestamp);
    }

    public function getRequestParamList()
    {
        return $this->getConstantListOf('REQUEST_PARAM_');
    }

    public function getAppKPIListForRequest()
    {
        return join(',', $this->getAppKPIList());
    }

    public function getAppKPIList()
    {
        return $this->getConstantListOf('KPIS_VALUE_APP');
    }

    public function getEventKPIListForRequest()
    {
        return 'all_' . join('|', $this->getEventKPIList());
    }

    public function getEventKPIList()
    {
        return $this->getConstantListOf('EVENT_KPIS_VALUE_');
    }

    public function getFraudKPIListForRequest()
    {
        return join(',', $this->getFraudKPIList());
    }

    public function getFraudKPIList()
    {
        return $this->getConstantListOf('FRAUD_KPIS_VALUE_');
    }

    public function getCostKPIListForRequest()
    {
        return join(',', $this->getCostKPIList());
    }

    public function getCostKPIList()
    {
        return $this->getConstantListOf('COST_KPIS_VALUE_');
    }

    public function getOSNamesList()
    {
        return $this->getConstantListOf('REQUEST_VALUE_OS_NAMES_');
    }

    public function getDeviceTypesList()
    {
        return $this->getConstantListOf('REQUEST_VALUE_DEVICE_TYPE_');
    }

    protected function getConstantListOf($key)
    {
        $self = new \ReflectionClass(get_called_class());
        $constants = $self->getConstants();
        $toReturn = [];
        foreach ($constants as $name => $const) {
            if (stripos($name, $key) === 0) {
                $toReturn[] = $const;
            }
        }
        return $toReturn;
    }
}

