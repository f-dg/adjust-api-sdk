<?php

namespace AdjustKPIServiceTest;

use AdjustKPIService\AbstractStatisticsValues,
    AdjustKPIService\OverviewStatisticsValues;

class AbstractStatisticsValuesTest extends \PHPUnit\Framework\TestCase
{
    protected $model;

    protected function setUp()
    {
        $this->model = $this->getMockedModel(['getConstantListOf']);
    }

    protected function tearDown()
    {
        $this->model = null;
    }

    public function testFormatRequestDate()
    {
        $date = $this->model->formatRequestDate(time());
        $this->assertContains(date('Y'), $date);
    }

    public function testGetRequestParamList()
    {
        $list = [
            AbstractStatisticsValues::REQUEST_PARAM_KPIS,
            AbstractStatisticsValues::REQUEST_PARAM_END_DAY,
            AbstractStatisticsValues::REQUEST_PARAM_START_DAY,
        ];

        $this->model->expects($this->once())
                    ->method('getConstantListOf')
                    ->with('REQUEST_PARAM_')
                    ->will($this->returnValue($list));

        $actualList = $this->model->getRequestParamList();
        $this->assertEquals($list, $actualList);
    }

    public function testGetAppKPIListForRequest()
    {
        $list = [
            OverviewStatisticsValues::KPIS_VALUE_APP_CLICKS,
            OverviewStatisticsValues::KPIS_VALUE_APP_CTR,
            OverviewStatisticsValues::KPIS_VALUE_APP_INSTALLS,
        ];

        $this->model = $this->getMockedModel(['getAppKPIList']);

        $this->model->expects($this->once())
                    ->method('getAppKPIList')
                    ->will($this->returnValue($list));

        $joinedActualList = $this->model->getAppKPIListForRequest();
        $this->assertContains(
            OverviewStatisticsValues::KPIS_VALUE_APP_CLICKS,
            $joinedActualList
        );
        $this->assertContains(
            OverviewStatisticsValues::KPIS_VALUE_APP_CTR,
            $joinedActualList
        );
        $this->assertContains(
            OverviewStatisticsValues::KPIS_VALUE_APP_INSTALLS,
            $joinedActualList
        );
    }

    public function testGetAppKPIList()
    {
        $list = [
            OverviewStatisticsValues::KPIS_VALUE_APP_CLICKS,
            OverviewStatisticsValues::KPIS_VALUE_APP_CTR,
            OverviewStatisticsValues::KPIS_VALUE_APP_INSTALLS,
        ];


        $this->model->expects($this->once())
                    ->method('getConstantListOf')
                    ->with('KPIS_VALUE_APP')
                    ->will($this->returnValue($list));

        $actualList = $this->model->getAppKPIList();
        $this->assertEquals($list, $actualList);
    }

    public function testGetEventKPIListForRequest()
    {
        $list = [
            OverviewStatisticsValues::EVENT_KPIS_VALUE_EVENTS,
            OverviewStatisticsValues::EVENT_KPIS_VALUE_FIRST_EVENTS,
        ];

        $this->model = $this->getMockedModel(['getEventKPIList']);

        $this->model->expects($this->once())
                    ->method('getEventKPIList')
                    ->will($this->returnValue($list));

        $joinedActualList = $this->model->getEventKPIListForRequest();
        $this->assertContains(
            OverviewStatisticsValues::EVENT_KPIS_VALUE_EVENTS,
            $joinedActualList
        );
        $this->assertContains(
            OverviewStatisticsValues::EVENT_KPIS_VALUE_FIRST_EVENTS,
            $joinedActualList
        );
    }

    public function testGetEventKPIList()
    {
        $list = [
            OverviewStatisticsValues::EVENT_KPIS_VALUE_EVENTS,
            OverviewStatisticsValues::EVENT_KPIS_VALUE_FIRST_EVENTS,
        ];

        $this->model->expects($this->once())
                    ->method('getConstantListOf')
                    ->with('EVENT_KPIS_VALUE_')
                    ->will($this->returnValue($list));

        $actualList = $this->model->getEventKPIList();
        $this->assertEquals($list, $actualList);
    }

    public function testGetFraudKPIListForRequest()
    {
        $list = [
            OverviewStatisticsValues::FRAUD_KPIS_VALUE_REJECTED_INSTALLS,
            OverviewStatisticsValues::FRAUD_KPIS_VALUE_REJECTED_INSTALLS_ANON_IP,
        ];

        $this->model = $this->getMockedModel(['getFraudKPIList']);

        $this->model->expects($this->once())
                    ->method('getFraudKPIList')
                    ->will($this->returnValue($list));

        $joinedActualList = $this->model->getFraudKPIListForRequest();
        $this->assertContains(
            OverviewStatisticsValues::FRAUD_KPIS_VALUE_REJECTED_INSTALLS,
            $joinedActualList
        );
        $this->assertContains(
            OverviewStatisticsValues::FRAUD_KPIS_VALUE_REJECTED_INSTALLS_ANON_IP,
            $joinedActualList
        );
    }

    public function testGetFraudKPIList()
    {
        $list = [
            OverviewStatisticsValues::FRAUD_KPIS_VALUE_REJECTED_INSTALLS,
            OverviewStatisticsValues::FRAUD_KPIS_VALUE_REJECTED_INSTALLS_ANON_IP,
        ];

        $this->model->expects($this->once())
                    ->method('getConstantListOf')
                    ->with('FRAUD_KPIS_VALUE_')
                    ->will($this->returnValue($list));

        $actualList = $this->model->getFraudKPIList();
        $this->assertEquals($list, $actualList);
    }

    public function testGetCostKPIListForRequest()
    {
        $list = [
            OverviewStatisticsValues::COST_KPIS_VALUE_ECPC,
            OverviewStatisticsValues::COST_KPIS_VALUE_ECPM,
        ];

        $this->model = $this->getMockedModel(['getCostKPIList']);

        $this->model->expects($this->once())
                    ->method('getCostKPIList')
                    ->will($this->returnValue($list));

        $joinedActualList = $this->model->getCostKPIListForRequest();
        $this->assertContains(
            OverviewStatisticsValues::COST_KPIS_VALUE_ECPC,
            $joinedActualList
        );
        $this->assertContains(
            OverviewStatisticsValues::COST_KPIS_VALUE_ECPM,
            $joinedActualList
        );
    }

    public function testGetCostKPIList()
    {
        $list = [
            OverviewStatisticsValues::COST_KPIS_VALUE_ECPC,
            OverviewStatisticsValues::COST_KPIS_VALUE_ECPM,
        ];

        $this->model->expects($this->once())
                    ->method('getConstantListOf')
                    ->with('COST_KPIS_VALUE_')
                    ->will($this->returnValue($list));

        $actualList = $this->model->getCostKPIList();
        $this->assertEquals($list, $actualList);
    }

    public function testGetOSNamesList()
    {
        $list = [
            OverviewStatisticsValues::REQUEST_VALUE_OS_NAMES_LINUX,
            OverviewStatisticsValues::REQUEST_VALUE_OS_NAMES_BLACKBERRY,
        ];

        $this->model->expects($this->once())
                    ->method('getConstantListOf')
                    ->with('REQUEST_VALUE_OS_NAMES_')
                    ->will($this->returnValue($list));

        $actualList = $this->model->getOSNamesList();
        $this->assertEquals($list, $actualList);
    }

    public function testGetDeviceTypesList()
    {
        $list = [
            OverviewStatisticsValues::REQUEST_VALUE_DEVICE_TYPE_UNKNOWN,
            OverviewStatisticsValues::REQUEST_VALUE_DEVICE_TYPE_TABLET,
        ];

        $this->model->expects($this->once())
                    ->method('getConstantListOf')
                    ->with('REQUEST_VALUE_DEVICE_TYPE_')
                    ->will($this->returnValue($list));

        $actualList = $this->model->getDeviceTypesList();
        $this->assertEquals($list, $actualList);
    }

    public function testGetConstantListOf()
    {
        $this->model = $this->getMockedModel();
        $method = $this->getMethod('getConstantListOf');
        $firstResult = $method->invoke($this->model, 'EVENT_KPIS_VALUE_');
        $this->assertTrue(is_array($firstResult));
        $this->assertTrue(count($firstResult) > 0);
        $secondResult = $method->invoke($this->model, 'FAKE_PARAM_');
        $this->assertTrue(is_array($secondResult));
        $this->assertEmpty($secondResult);
    }

    protected function getMockedModel(array $methodsToMocking = [])
    {
        return $this->getMockForAbstractClass(
            AbstractStatisticsValues::class,
            [],
            '',
            true,
            true,
            true,
            $methodsToMocking
        );
    }

    protected function getMethod($name)
    {
        $class = new \ReflectionClass($this->model);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}

