<?php
namespace Unit\Services\HttpClient;

use JournalMedia\Sample\Configurations\ConfigurationAbstract;
use JournalMedia\Sample\Services\HttpClient\HttpClient;
use JournalMedia\Sample\Services\HttpClient\HttpClientAbstract;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class HttpClientTest
 * @package Unit\Services\HttpClient
 */
class HttpClientTest extends TestCase
{
    /**
     * @var HttpClient
     */
    private $httpClient;
    private $configurationValues;

    /**
     * HttpClientTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->httpClient = new HttpClient();
        $this->configurationValues = [
            'parameter' => 'Publication/{name_file}.json',
            'mask' => '{name_file}',
            'configs' => [
                'config test'
            ]
        ];
    }

    public function test_instanceof()
    {
        $this->assertInstanceOf(HttpClientAbstract::class, $this->httpClient);
    }

    public function test_load_result()
    {
        $this->httpClient->setConfiguration($this->getConfigurationStub());
        $this->callMethod($this->httpClient, 'setParameter', ['thejournal']);
        $result = json_decode($this->httpClient->load(), true);
        $this->assertFalse(is_null($result));
        $this->assertTrue(is_array($result));
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

        $this->callMethod($stub, 'loadRules', [__DIR__ . '/../../Configurations/Rivers/Rules/fakerTest.json']);

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