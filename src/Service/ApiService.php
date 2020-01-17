<?php

namespace JournalMedia\Sample\Service;

use JournalMedia\Sample\Service\DataService;
/**
 * Class ApiService
 * @package JournalMedia\Sample\Service
 */
class ApiService extends DataService
{
    /**
     * Fetch articles from API
     *
     * @return array
     */
    public function fetch(): array
    {
        try {
            // Get cURL resource
            $curl = curl_init();
            // Set options
            curl_setopt($curl, CURLOPT_URL, $this->getUrl());
            curl_setopt($curl, CURLOPT_USERPWD, getenv('API_USERNAME') . ":" . getenv('API_PASSWORD'));
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

            $response = curl_exec($curl);
            $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            // Close request to clear up some resources
            curl_close($curl);

            if ($httpStatus == 200) {
                $jsonData = json_decode($response);

                if (!empty($jsonData->response->articles)) {
                    return $jsonData->response->articles;
                }
            }
        } catch (Exception $e) {

        }

        return [];
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        $baseUrl = getenv('API_URL');
        $tagUrl = empty($this->getTag()) ? "" : "tag/" . $this->getTag();
        $publicationUrl = empty($this->getPublication()) ? "" : $this->getPublication() . "/";
        $publicationUrl = empty($publicationUrl) && empty($tagUrl) ?  $this->getPublication() . "/" : $publicationUrl;

        if (!empty($tagUrl)) {
            return $baseUrl . $tagUrl;
        }

        return $baseUrl . $publicationUrl;
    }
}