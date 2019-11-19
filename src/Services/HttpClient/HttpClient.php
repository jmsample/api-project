<?php
namespace JournalMedia\Sample\Services\HttpClient;

/**
 * Class HttpClient
 * @package JournalMedia\Sample\Services\HttpClient
 */
class HttpClient extends HttpClientAbstract
{
    /**
     * @param string $method
     * @return false|string
     * @throws \Exception
     */
    public function load($method = 'GET')
    {
        if (! array_key_exists('completePath', $this->path)) {
            throw new \Exception('configuration error : miss completePath');
        }
        $context  = stream_context_create($this->getOpts($method));

        return file_get_contents($this->path['completePath'], false, $context);
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function generateHeader(): string
    {
        if (! array_key_exists('completePath', $this->path)) {
            throw new \Exception('configuration error : miss completePath');
        }

        return implode('\r\n', $this->path['configs']);
    }

    /**
     * @param $method
     * @return array
     * @throws \Exception
     */
    private function getOpts($method)
    {
        return ['http' =>
            [
                'method'  => $method,
                'header'  => $this->generateHeader(),
            ]
        ];
    }
}