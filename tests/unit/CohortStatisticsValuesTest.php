<?php

namespace AdjustKPIServiceTest;

use AdjustKPIService\AbstractStatisticsValues,
    AdjustKPIService\CohortStatisticsValues;

class CohortStatisticsValuesTest extends \PHPUnit\Framework\TestCase
{
    protected $model;

    protected function setUp()
    {
        $this->model = $this->getMockedModel([
            'getConstantListOf',
            'getCohortKPIList',
        ]);
    }

    protected function tearDown()
    {
        $this->model = null;
    }

    protected function getMockedModel(array $methods = [])
    {
        return $this->getMockBuilder(CohortStatisticsValues::class)
            ->setMethods($methods)
            ->getMock();
    }

    public function testGetCohortKPIListForRequest()
    {
        $list = [
            CohortStatisticsValues::COHORT_KPIS_VALUE_EVENTS_PER_USER,
            CohortStatisticsValues::COHORT_KPIS_VALUE_REVENUE_TOTAL,
        ];

        $this->model->expects($this->once())
                    ->method('getCohortKPIList')
                    ->will($this->returnValue($list));

        $joinedActualList = $this->model->getCohortKPIListForRequest();
        $this->assertContains(
            CohortStatisticsValues::COHORT_KPIS_VALUE_EVENTS_PER_USER,
            $joinedActualList
        );
        $this->assertContains(
            CohortStatisticsValues::COHORT_KPIS_VALUE_REVENUE_TOTAL,
            $joinedActualList
        );
    }

    public function testGetCohortKPIList()
    {
        $this->model = new CohortStatisticsValues;

        $actualList = $this->model->getCohortKPIList();
        $this->assertTrue(is_array($actualList));
        $this->assertTrue(count($actualList) > 0);
        $this->assertTrue(in_array(
            CohortStatisticsValues::COHORT_KPIS_VALUE_EVENTS_PER_USER,
            $actualList
        ));
        $this->assertFalse(in_array(
            CohortStatisticsValues::REQUEST_VALUE_GROUPING_PERIODS,
            $actualList
        ));
    }
}

