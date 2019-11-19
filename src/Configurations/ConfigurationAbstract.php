<?php
namespace JournalMedia\Sample\Configurations;

use JournalMedia\Sample\Contracts\ConfigurationInterface;

/**
 * Class ConfigurationAbstract
 * @package JournalMedia\Sample\Configurations
 */
abstract class ConfigurationAbstract implements ConfigurationInterface
{
    private $path;
    private $parameter;
    private $mask;
    private $configs = [];
    protected $rules = [];

    /**
     * @return array
     * @throws \Exception
     */
    public function loadConfiguration(): array
    {
        $this->path = $this->path();
        $this->parameter = $this->parameter();
        $this->mask = $this->mask();
        $this->configs = $this->configs();

        return [
            'path' => $this->path,
            'parameter' => $this->parameter,
            'mask' => $this->mask,
            'configs' => $this->configs
        ];
    }

    /**
     * @param $parameterValue
     * @return array
     * @throws \Exception
     */
    public function getPath($parameterValue): array
    {
        if (empty($this->path)) {
            $return = $this->loadConfiguration();
            $return['completePath'] = $this->completeParameters($parameterValue);
            return $return;
        }

        return [
            'path' => $this->path,
            'parameter' => $this->parameter,
            'mask' => $this->mask,
            'configs' => $this->configs,
            'completePath' => $this->completeParameters($parameterValue)
        ];
    }

    /**
     * @param $response
     * @return array
     */
    public function checkResult($response): array
    {
        return $this->filter($this->check($response));
    }

    /**
     * @param array $response
     * @return array
     */
    private function filter(array $response)
    {
        foreach ($response as $key => $river) {
            if (! array_key_exists('type', $river) || $river['type'] != 'post') {
                unset($response[$key]);
            }
        }
        return $response;
    }

    /**
     * @param $parameterValue
     * @return string
     */
    private function completeParameters($parameterValue): string
    {
        return $this->path . str_replace($this->mask, $parameterValue, $this->parameter);
    }

    /**
     * @param $path
     * @return array
     * @throws \Exception
     */
    protected function loadRules($path): array
    {
        $this->rules = json_decode(file_get_contents($path), true);

        if (! $this->rules) {
            throw new \Exception('invalid rule : can\'t load ');
        }
        return $this->rules;
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function path(): string
    {
        if (! array_key_exists('path', $this->rules)) {
            throw new \Exception('invalid rule : miss path');
        }

        return $this->rules['path'];
    }

    abstract public function parameter();
    abstract public function mask();
    abstract public function configs();
    abstract public function check($response);
}