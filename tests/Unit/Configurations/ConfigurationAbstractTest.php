<?php
namespace Unit\Configurations;

use JournalMedia\Sample\Configurations\ConfigurationAbstract;
use JournalMedia\Sample\Contracts\ConfigurationInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class ConfigurationAbstractTest
 * @package Unit\Configurations
 */
class ConfigurationAbstractTest extends TestCase
{
    public function test_configuration_insanceof()
    {
        $mock = \Mockery::mock(ConfigurationAbstract::class);
        $this->assertInstanceOf(ConfigurationInterface::class, $mock);
    }

    public function test_load_configuration_return()
    {
        $stub = $this->getMockForAbstractClass(ConfigurationAbstract::class);

        $returnExpected = [
            'path' => 'http://path.test/',
            'parameter' => 'test/{test}',
            'mask' => '{test}',
            'configs' => [
                'config test'
            ]
        ];
        
        $stub->expects($this->any())
            ->method('parameter')
            ->will($this->returnValue($returnExpected['parameter']));
        $stub->expects($this->any())
            ->method('mask')
            ->will($this->returnValue($returnExpected['mask']));
        $stub->expects($this->any())
            ->method('configs')
            ->will($this->returnValue($returnExpected['configs']));

        $this->callMethod($stub, 'loadRules', [__DIR__ . '/Rivers/Rules/test.json']);
        $return = $stub->loadConfiguration();

        $this->assertEquals($returnExpected, $return);
    }

    public function test_load_configuration_error()
    {
        $stub = $this->getMockForAbstractClass(ConfigurationAbstract::class);
        $this->expectException(\Exception::class);
        $stub->loadConfiguration();
    }

    public function test_get_path_return()
    {
        $stub = $this->getMockForAbstractClass(ConfigurationAbstract::class);

        $returnExpected = [
            'path' => 'http://path.test/',
            'parameter' => 'test/{test}',
            'mask' => '{test}',
            'configs' => [
                'config test'
            ],
            'completePath' => 'http://path.test/test/parameter'
        ];
     
        $stub->expects($this->any())
            ->method('parameter')
            ->will($this->returnValue($returnExpected['parameter']));
        $stub->expects($this->any())
            ->method('mask')
            ->will($this->returnValue($returnExpected['mask']));
        $stub->expects($this->any())
            ->method('configs')
            ->will($this->returnValue($returnExpected['configs']));

        $this->callMethod($stub, 'loadRules', [__DIR__ . '/Rivers/Rules/test.json']);
        $return = $stub->getPath('parameter');

        $this->assertEquals($returnExpected, $return);
    }

    public function test_get_path_error()
    {
        $stub = $this->getMockForAbstractClass(ConfigurationAbstract::class);
        $this->expectException(\Exception::class);
        $stub->getPath('parameter');
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