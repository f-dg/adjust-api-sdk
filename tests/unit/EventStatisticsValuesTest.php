<?php

namespace AdjustKPIServiceTest;

use AdjustKPIService\AbstractStatisticsValues,
    AdjustKPIService\EventStatisticsValues;

class EventStatisticsValuesTest extends \PHPUnit\Framework\TestCase
{
    protected $model;

    protected function setUp()
    {
    }

    protected function tearDown()
    {
        $this->model = null;
    }

    public function testGetCohortKPIList()
    {
        $this->model = new EventStatisticsValues;

        $actualJoinedList = $this->model->getEventKPIListForRequest();

        $this->assertContains(
            EventStatisticsValues::EVENT_KPIS_VALUE_REVENUE_EVENTS,
            $actualJoinedList
        );

        $this->assertNotContains('all', $actualJoinedList);
        $this->assertNotContains(
            EventStatisticsValues::REQUEST_PARAM_UTC_OFFSET, 
            $actualJoinedList
        );
    }
}

