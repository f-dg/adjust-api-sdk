<?php

namespace AdjustKPIServiceTest;

use AdjustKPIService\ResponseFormatter,
    AdjustKPIService\ResponseFormatterException,
    AdjustKPIService\AdjustKPIServiceException;

class ResponseFormatterTest extends \PHPUnit\Framework\TestCase
{
    protected $_response = '{"result_parameters": {"kpis": ["sessions", "installs"], "start_date": "2015-05-01", "end_date": "2015-05-31", "sandbox": false, "countries": ["de", "gb"], "trackers": [ { "token": "foobar", "name": "Network 1", "has_subtrackers": true }, { "token": "15jvui", "name": "Network 2", "has_subtrackers": true } ], "grouping": ["trackers"] }, "result_set": { "token": "2eb2na2w54c3", "name": "app name", "currency": "USD", "trackers": [ { "token": "foobar", "kpi_values": [100, 299] }, { "token": "15jvui", "kpi_values": [557, 880]}]}}';

    public function testCreateInstanceFail()
    {
        $this->expectException(AdjustKPIServiceException::class);
        new ResponseFormatter('wrong type');
    }

    public function testCreateInstance()
    {
        $this->assertTrue(is_object(new ResponseFormatter));
    }
    
    public function testAcceptHeader()
    {
        $model = new ResponseFormatter;
        $this->assertEquals('Accept: application/json', $model->getAcceptHeader());

        $model = new ResponseFormatter(ResponseFormatter::RESPONSE_TYPE_JSON);
        $this->assertEquals('Accept: application/json', $model->getAcceptHeader());

        $model = new ResponseFormatter(ResponseFormatter::RESPONSE_TYPE_CSV);
        $this->assertEquals('Accept: text/csv', $model->getAcceptHeader());
    }

    public function testFormatResponse1()
    {
        $decodedResponse = json_decode($this->_response, 1);

        $model = $this->getMockBuilder(ResponseFormatter::class)
                      ->setMethods(['formatAsJSON'])
                      ->getMock();

        $model->expects($this->once())
              ->method('formatAsJSON')
              ->with($this->_response)
              ->will($this->returnValue($decodedResponse));

        $this->assertEquals($decodedResponse, $model->formatResponse($this->_response));
    }

    public function testFormatResponse2()
    {
        $decodedResponse = json_decode($this->_response, 1);

        $model = $this->getMockBuilder(ResponseFormatter::class)
                      ->setConstructorArgs([ResponseFormatter::RESPONSE_TYPE_JSON])
                      ->setMethods(['formatAsJSON'])
                      ->getMock();

        $model->expects($this->once())
              ->method('formatAsJSON')
              ->with($this->_response)
              ->will($this->returnValue($decodedResponse));

        $this->assertEquals($decodedResponse, $model->formatResponse($this->_response));
    }

    public function testFormatResponse3()
    {
        $model = $this->getMockBuilder(ResponseFormatter::class)
                      ->setConstructorArgs([ResponseFormatter::RESPONSE_TYPE_CSV])
                      ->setMethods(['formatAsCSV'])
                      ->getMock();

        $model->expects($this->once())
              ->method('formatAsCSV')
              ->with($this->_response)
              ->will($this->throwException(new ResponseFormatterException));

        $this->expectException(ResponseFormatterException::class);
        $model->formatResponse($this->_response);
    }

    public function testFormatAsJSON()
    {
        $model = new ResponseFormatter;
        $method = $this->getMethod('formatAsJSON', $model);
        $decodedResponse = json_decode($this->_response, 1);
        $this->assertEquals($decodedResponse, $method->invoke($model, $this->_response));
    }

    public function testFormatAsCSV()
    {
        $model = new ResponseFormatter;
        $method = $this->getMethod('formatAsCSV', $model);
        $this->expectException(ResponseFormatterException::class);
        $method->invoke($model, $this->_response);
    }

    protected function getMethod($name, $model)
    {
        $class = new \ReflectionClass($model);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}

