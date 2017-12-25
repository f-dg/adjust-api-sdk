<?php

namespace AdjustKPIServiceTest;

use AdjustKPIService\AbstractStatistics,
    AdjustKPIService\AdjustKPIServiceException,
    AdjustKPIService\ResponseFormatter,
    AdjustKPIService\adapter\CurlAdapter;

class AbstractStatisticsTest extends \PHPUnit\Framework\TestCase
{
    protected $model,
              $mockedCurl,
              $apiConfig,
              $apiResponse,
              $httpHeaders;

    protected function setUp()
    {
        $this->apiResponse = '{"result_parameters": {"kpis": ["sessions", "installs"], "start_date": "2015-05-01", "end_date": "2015-05-31", "sandbox": false, "countries": ["de", "gb"], "trackers": [ { "token": "foobar", "name": "Network 1", "has_subtrackers": true }, { "token": "15jvui", "name": "Network 2", "has_subtrackers": true } ], "grouping": ["trackers"] }, "result_set": { "token": "2eb2na2w54c3", "name": "app name", "currency": "USD", "trackers": [ { "token": "foobar", "kpi_values": [100, 299] }, { "token": "15jvui", "kpi_values": [557, 880]}]}}';

        $this->apiConfig = [
            'user_token' => 'token',
            'app_token' => 'token',
        ];

        $this->httpHeaders = [
            'Accept: application/json',
            'Authorization: Token token=' . $this->apiConfig['user_token'],
        ];

        $this->model = $this->getMockedModel();
    }

    protected function tearDown()
    {
        $this->model = null;
        $this->mockedCurl = null;
    }

    public function testCreateInstanceFail1()
    {
        $this->apiConfig['user_token'] = null;
        $this->expectException(AdjustKPIServiceException::class);
        $this->getMockedModel();
    }

    public function testCreateInstanceFail2()
    {
        $this->apiConfig['app_token'] = null;
        $this->expectException(AdjustKPIServiceException::class);
        $this->getMockedModel();
    }

    public function testGetResponseFormatter()
    {
        $method = $this->getMethod('getResponseFormatter');
        $responseFormatter = $method->invoke($this->model, $this->apiConfig);

        $this->assertInstanceOf(ResponseFormatter::class, $responseFormatter);
        $this->assertStringEndsWith(
            'application/json',
            $responseFormatter->getAcceptHeader()
        );

        $this->apiConfig['response_type'] = ResponseFormatter::RESPONSE_TYPE_CSV;
        $responseFormatter = $method->invoke($this->model, $this->apiConfig);
        $this->assertStringEndsWith(
            'text/csv',
            $responseFormatter->getAcceptHeader()
        );

        $this->expectException(AdjustKPIServiceException::class);
        $this->apiConfig['response_type'] = 'wrong response type';
        $responseFormatter = $method->invoke($this->model, $this->apiConfig);
    }

    public function testGetData()
    {
        $this->model = $this->getMockedModel([
            'getAcceptHeader',
            'getAuthorizationHeader',
            'fetch',
        ]);

        $params = [
            'start_date' => date('Y-m-d', strtotime('today midnight')),
            'end_date' => date('Y-m-d', time()),
            'kpis' => ['clicks', 'installs'],
        ];

        $this->model->expects($this->once())
                    ->method('getAcceptHeader')
                    ->will($this->returnValue($this->httpHeaders[0]));

        $this->model->expects($this->once())
                    ->method('getAuthorizationHeader')
                    ->will($this->returnValue($this->httpHeaders[1]));

        $this->model->expects($this->once())
                    ->method('fetch')
                    ->with($this->equalTo($params), $this->equalTo($this->httpHeaders))
                    ->will($this->returnValue($this->apiResponse));

        $response = $this->model->getData($params);

        $this->assertArrayHasKey('result_parameters', $response);
        $this->assertArrayHasKey('result_set', $response);
    }

    public function testGetAcceptHeader()
    {
        $method = $this->getMethod('getAcceptHeader');
        $httpHeader = $method->invoke($this->model);
        $this->assertEquals($this->httpHeaders[0], $httpHeader);

        $this->apiConfig['response_type'] = ResponseFormatter::RESPONSE_TYPE_CSV;
        $this->model = $this->getMockedModel();

        $method = $this->getMethod('getAcceptHeader');
        $httpHeader = $method->invoke($this->model);
        $this->assertEquals('Accept: text/csv', $httpHeader);
    }

    public function testGetAuthorizationHeader()
    {
        $method = $this->getMethod('getAuthorizationHeader');
        $httpHeader = $method->invoke($this->model);
        $this->assertEquals($this->httpHeaders[1], $httpHeader);
    }

    public function testFetch()
    {
        $fetch = $this->getMethod('fetch');
        $makeEndpoint = $this->getMethod('makeEndpoint');
        $makeEndpoint->invoke($this->model);

        $endpoint = $this->getPropertyValue('_endpoint');

        $params = [
            'start_date' => date('Y-m-d', strtotime('today midnight')),
            'end_date' => date('Y-m-d', time()),
            'kpis' => ['clicks', 'installs'],
        ];

        $this->mockedCurl->expects($this->once())
                         ->method('getRequest')
                         ->with(
                             $this->equalTo($endpoint),
                             $this->equalTo($params),
                             $this->equalTo($this->httpHeaders)
                         )
                         ->will($this->returnValue($this->apiResponse));

        $actualApiResponse = $fetch->invoke($this->model, $params, $this->httpHeaders);
        $this->assertEquals($this->apiResponse, $actualApiResponse);
    }

    public function testMakeEndpoint()
    {
        $makeEndpoint = $this->getMethod('makeEndpoint');
        $makeEndpoint->invoke($this->model);

        $endpoint = $this->getPropertyValue('_endpoint');

        $this->assertStringEndsWith(
            $this->apiConfig['app_token'] . '?',
            $endpoint
        );

        $this->assertContains(
            AbstractStatistics::DEFAULT_ENDPOINT_VERSION,
            $endpoint
        );

        $this->assertContains(AbstractStatistics::DEFAULT_ENDPOINT, $endpoint);

        $this->apiConfig['endpoint_version'] = 'v2';
        $this->apiConfig['tracker_token'] = 'tracker_token';
        $this->model = $this->getMockedModel();

        $makeEndpoint->invoke($this->model);

        $endpoint = $this->getPropertyValue('_endpoint');

        $this->assertContains('v2', $endpoint);
        $this->assertContains('tracker_token', $endpoint);
    }

    public function testMakeEndpointFail()
    {
        $makeEndpoint = $this->getMethod('makeEndpoint');
        $this->apiConfig['endpoint'] = 'fake endpoint';
        $this->model = $this->getMockedModel();
        $this->expectException(AdjustKPIServiceException::class);
        $makeEndpoint->invoke($this->model);
    }

    protected function getMockedModel(array $methodsToMocking = [])
    {
        return $this->getMockForAbstractClass(
            AbstractStatistics::class,
            [
                $this->getMockedCurlAdapter(),
                $this->apiConfig,
            ],
            '',
            true,
            true,
            true,
            $methodsToMocking
        );
    }

    protected function getMockedCurlAdapter()
    {
        if (empty($this->mockedCurl)) {
            $this->mockedCurl = $this->getMockBuilder(CurlAdapter::class)
                        ->setMethods(['getRequest'])
                        ->getMock();
        }

        return $this->mockedCurl;
    }

    protected function getMethod($name)
    {
        $class = new \ReflectionClass($this->model);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    protected function getPropertyValue($name)
    {
        $class = new \ReflectionClass($this->model);
        $property = $class->getProperty($name);
        $property->setAccessible(true);
        return $property->getValue($this->model);
    }
}

