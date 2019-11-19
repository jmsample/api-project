<?php
namespace Unit\Configurations\Rivers;

use JournalMedia\Sample\Configurations\ConfigurationAbstract;
use JournalMedia\Sample\Configurations\Rivers\TagRiverConfiguration;
use PHPUnit\Framework\TestCase;

/**
 * Class TagRiverConfigurationTest
 * @package Unit\Configurations\Rivers
 */
class TagRiverConfigurationTest extends TestCase
{
    /**
     * @var TagRiverConfiguration
     */
    private $configuration;

    /**
     * TagRiverConfigurationTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     * @throws \Exception
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->configuration = new TagRiverConfiguration();
    }

    public function test_instanceof()
    {
        $this->assertInstanceOf(ConfigurationAbstract::class, $this->configuration);
    }

    public function test_parameter_return()
    {
        $parameterExpected = 'sample/tag/{slug}';
        $parameter = $this->configuration->parameter();
        $this->assertEquals($parameterExpected, $parameter);
    }

    public function test_mask_return()
    {
        $maskExpected = '{slug}';
        $mask = $this->configuration->mask();
        $this->assertEquals($maskExpected, $mask);
    }

    public function test_configs_return()
    {
        $auth = [
            'user_name' => getenv('RIVER_USER_NAME'),
            'password' => getenv('RIVER_PASSWORD')
        ];
        $auth = base64_encode($auth['user_name'] . ':' . $auth['password']);
        $configExpected = ["Authorization: Basic {$auth}"];
        $config = $this->configuration->configs();
        $this->assertEquals($configExpected, $config);
    }

    public function test_check_return()
    {
        $resultExpected = ['test return'];
        $responseTest = [
            'status' => 1,
            'response' =>[
                'articles' => $resultExpected
            ]
        ];
        $checkResult = $this->configuration->check($responseTest);

        $this->assertEquals($resultExpected, $checkResult);
    }
}