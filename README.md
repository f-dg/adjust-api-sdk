Adjust's web api documentations
===============================

[Official doc](https://docs.adjust.com/en/kpi-service)

A note - do not read a rus variant of the docs, cause some not translated docblock just dropped

Description
===========

This SDK not fully implemented according to the official doc
Feel free to add a new code to the SDK, but do not forget about unit tests

The default is:
 + ```response``` as JSON", "CSV" not implemented
 + time zone of account's

Adjust's API does not support a query to fetch list of applications

Installation
============

via composer.json

```json
  "require": {
    "f-dg/adjust-api-sdk": "dev-master"
  }
```

or via git clone

```shell
git clone git@github.com:f-dg/adjust-api-sdk.git
```

Example of fetching Overview statistics
=======================================

```php
    use \AdjustKPIService\OverviewStatistics,
        \AdjustKPIService\OverviewStatisticsValues as Params,
        \AdjustKPIService\adapter\CurlAdapter,
        \AdjustKPIService\AdjustKPIServiceException;

    try {

        $curlAdapter = new CurlAdapter;
        $apiConfig = [
            'user_token'    => 'token1',
            'app_token'     => 'token2',
        ];

        $startTimestamp = strtotime('-30 days');
        $endTimestamp   = time();
        $params = new Params;

        $overviewStats = new OverviewStatistics($curlAdapter, $apiConfig);
        $data = $overviewStats->getData([
            Params::REQUEST_PARAM_UTC_OFFSET => '00:00',
            Params::REQUEST_PARAM_START_DAY  => $params->formatRequestDate($startTimestamp),
            Params::REQUEST_PARAM_END_DAY    => $params->formatRequestDate($endTimestamp),
            Params::REQUEST_PARAM_KPIS       => $params->getAppKPIListForRequest(),
            Params::REQUEST_PARAM_EVENT_KPIS => $params->getEventKPIListForRequest(),
            Params::REQUEST_PARAM_GROUPING   => join(',', [Params::REQUEST_VALUE_GROUPING_TRACKER]),
        ]);

        print_r($data);

    } catch (AdjustKPIServiceException $e) {
        echo 'An error occurred: ' . PHP_EOL . $e->getMessage() . PHP_EOL;
    }
```
Example of fetching Event statistics
=======================================

```php
    use \AdjustKPIService\EventStatistics,
        \AdjustKPIService\EventStatisticsValues as Params,
        \AdjustKPIService\adapter\CurlAdapter,
        \AdjustKPIService\AdjustKPIServiceException;

    try {

        $curlAdapter = new CurlAdapter;
        $apiConfig = [
            'user_token'    => 'token1',
            'app_token'     => 'token2',
        ];

        $startTimestamp = strtotime('-30 days');
        $endTimestamp   = time();
        $params = new Params;

        $eventStats = new EventStatistics($curlAdapter, $apiConfig);
        $data = $eventStats->getData([
            Params::REQUEST_PARAM_UTC_OFFSET => '00:00',
            Params::REQUEST_PARAM_START_DAY  => $params->formatRequestDate($startTimestamp),
            Params::REQUEST_PARAM_END_DAY    => $params->formatRequestDate($endTimestamp),
            Params::REQUEST_PARAM_KPIS       => $params->getEventKPIListForRequest(),
            Params::REQUEST_PARAM_GROUPING   => join(',', [
                Params::REQUEST_VALUE_GROUPING_TRACKER,
                Params::REQUEST_VALUE_GROUPING_COUNTRIES,
                Params::REQUEST_VALUE_GROUPING_DAY,
            ]),
        ]);

        print_r($data);

    } catch (AdjustKPIServiceException $e) {
        echo 'An error occurred: ' . PHP_EOL . $e->getMessage() . PHP_EOL;
    }
```

Example of fetching Cohort statistics
=======================================

```php
    use \AdjustKPIService\CohortStatistics,
        \AdjustKPIService\CohortStatisticsValues as Params,
        \AdjustKPIService\adapter\CurlAdapter,
        \AdjustKPIService\AdjustKPIServiceException;

    try {

        $curlAdapter = new CurlAdapter;
        $apiConfig = [
            'user_token'    => 'token1',
            'app_token'     => 'token2',
        ];

        $startTimestamp = strtotime('-30 days');
        $endTimestamp   = time();
        $params = new Params;

        $cohortStats = new CohortStatistics($curlAdapter, $apiConfig);
        $data = $cohortStats->getData([
            Params::REQUEST_PARAM_UTC_OFFSET => '00:00',
            Params::REQUEST_PARAM_START_DAY  => $params->formatRequestDate($startTimestamp),
            Params::REQUEST_PARAM_END_DAY    => $params->formatRequestDate($endTimestamp),
            Params::REQUEST_PARAM_KPIS       => $params->getCohortKPIListForRequest(),
            Params::REQUEST_PARAM_GROUPING   => join(',', [
                Params::REQUEST_VALUE_GROUPING_TRACKER,
                Params::REQUEST_VALUE_GROUPING_COUNTRIES,
                Params::REQUEST_VALUE_GROUPING_DAY,
            ]),
        ]);

        print_r($data);

    } catch (AdjustKPIServiceException $e) {
        echo 'An error occurred: ' . PHP_EOL . $e->getMessage() . PHP_EOL;
    }
```

Unit tests
----------

You may need to edit path to autoload.php in the phpunit.xml
```xml
bootstrap="./vendor/autoload.php"
```

```shell
cd path/to/adjust-api-sdk/tests && phpunit -v -c ../phpunit.xml . --coverage-text
```
