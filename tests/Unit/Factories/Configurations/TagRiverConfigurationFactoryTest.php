<?php
namespace Unit\Factories\Configurations;

use JournalMedia\Sample\Configurations\Rivers\TagRiverConfiguration;
use JournalMedia\Sample\Configurations\Rivers\TagRiverFakerConfiguration;
use JournalMedia\Sample\Contracts\FactoryInterface;
use JournalMedia\Sample\Factories\Configurations\TagRiverConfigurationFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class TagRiverConfigurationFactoryTest
 * @package Unit\Factories\Configurations
 */
class TagRiverConfigurationFactoryTest extends TestCase
{
    /**
     * @var TagRiverConfigurationFactory
     */
    private $factory;

    /**
     * TagRiverConfigurationFactoryTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->factory = new TagRiverConfigurationFactory();
    }

    public function test_instanceof()
    {
        $this->assertInstanceOf(FactoryInterface::class, $this->factory);
    }

    public function test_create_demo_true()
    {
        $this->setValueAttribute($this->factory, 'isDemoMode', true);
        $obj = $this->factory->create();
        $this->assertInstanceOf(TagRiverFakerConfiguration::class, $obj);
    }

    public function test_create_demo_false()
    {
        $this->setValueAttribute($this->factory, 'isDemoMode', false);
        $obj = $this->factory->create();
        $this->assertInstanceOf(TagRiverConfiguration::class, $obj);
    }

    /**
     * @param $obj
     * @param $attribute
     * @param $value
     * @throws \ReflectionException
     */
    private function setValueAttribute($obj, $attribute, $value)
    {
        $reflection = new \ReflectionProperty(get_class($obj), $attribute);
        $reflection->setAccessible(true);
        $reflection->setValue($obj, $value);
    }
}