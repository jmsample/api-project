<?php
namespace Unit\Configurations\Rivers;

use JournalMedia\Sample\Configurations\ConfigurationAbstract;
use JournalMedia\Sample\Configurations\Rivers\PublicationRiverFakerConfiguration;
use PHPUnit\Framework\TestCase;

class PublicationRiverFakerConfigurationTest extends TestCase
{
    /**
     * @var PublicationRiverFakerConfiguration
     */
    private $configuration;

    /**
     * PublicationRiverFakerConfigurationTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     * @throws \Exception
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->configuration = new PublicationRiverFakerConfiguration();
    }

    public function test_instanceof()
    {
        $this->assertInstanceOf(ConfigurationAbstract::class, $this->configuration);
    }

    public function test_parameter_return()
    {
        $parameterExpected = 'Publication/{name_file}.json';
        $parameter = $this->configuration->parameter();
        $this->assertEquals($parameterExpected, $parameter);
    }

    public function test_mask_return()
    {
        $maskExpected = '{name_file}';
        $mask = $this->configuration->mask();
        $this->assertEquals($maskExpected, $mask);
    }

    public function test_configs_return()
    {
        $configExpected = ['Content-Type: application/json'];
        $config = $this->configuration->configs();
        $this->assertEquals($configExpected, $config);
    }

    public function test_check_return()
    {
        $responseTest = ['test return'];

        $checkResult = $this->configuration->check($responseTest);

        $this->assertEquals($responseTest, $checkResult);
    }
}