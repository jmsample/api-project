<?php
namespace Unit\Services\HttpClient;

use JournalMedia\Sample\Configurations\ConfigurationAbstract;
use JournalMedia\Sample\Contracts\ConfigurationInterface;
use JournalMedia\Sample\Contracts\HttpClientInterface;
use JournalMedia\Sample\Services\HttpClient\HttpClientAbstract;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class HttpClientAbstractTest
 * @package Unit\Services\HttpClient
 */
class HttpClientAbstractTest extends TestCase
{
    private $configurationValues;

    /**
     * HttpClientAbstractTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->configurationValues = [
            'path' => 'http://path.test/',
            'parameter' => 'test/{test}',
            'mask' => '{test}',
            'configs' => [
                'config test'
            ],
            'completePath' => 'http://path.test/test/parameter'
        ];
    }

    public function test_instanceof()
    {
        $mock = \Mockery::mock(HttpClientAbstract::class);
        $this->assertInstanceOf(HttpClientInterface::class, $mock);
    }

    public function test_set_configuration_return()
    {
        $stub = $this->getMockForAbstractClass(HttpClientAbstract::class);
        $configurationMock = \Mockery::mock(ConfigurationAbstract::class);
        $result = $stub->setConfiguration($configurationMock);
        $this->assertInstanceOf(ConfigurationAbstract::class, $result);
        $this->assertInstanceOf(ConfigurationInterface::class, $result);
    }

    public function test_set_parameter_return()
    {
        $stub = $this->getMockForAbstractClass(HttpClientAbstract::class);
        $configurationStub = $this->getConfigurationStub();
        $stub->setConfiguration($configurationStub);
        $path = $this->callMethod($stub, 'setParameter', ['parameter']);
        $this->assertEquals($this->configurationValues, $path);
    }

    public function test_get_return()
    {
        $stub = $this->getMockForAbstractClass(HttpClientAbstract::class);
        $configurationStub = $this->getConfigurationStub();
        $stub->setConfiguration($configurationStub);
        $stub->expects($this->any())
            ->method('load')
            ->will($this->returnValue('{"response": "response"}'));

        $result = $stub->get('response');

        $this->assertEquals('{"response": "response"}', $result);
    }

    /**
     * @return MockObject
     * @throws \ReflectionException
     */
    private function getConfigurationStub()
    {
        $stub = $this->getMockForAbstractClass(ConfigurationAbstract::class);

        $stub->expects($this->any())
            ->method('parameter')
            ->will($this->returnValue($this->configurationValues['parameter']));
        $stub->expects($this->any())
            ->method('mask')
            ->will($this->returnValue($this->configurationValues['mask']));
        $stub->expects($this->any())
            ->method('configs')
            ->will($this->returnValue($this->configurationValues['configs']));

        $this->callMethod($stub, 'loadRules', [__DIR__ . '/../../Configurations/Rivers/Rules/test.json']);

        return $stub;
    }

    /**
     * @param $obj
     * @param $name
     * @param array $args
     * @return mixed
     * @throws \ReflectionException
     */
    public static function callMethod($obj, $name, array $args) {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($obj, $args);
    }
}