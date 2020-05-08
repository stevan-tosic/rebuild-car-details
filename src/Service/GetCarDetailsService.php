<?php declare(strict_types = 1);

namespace App\Service;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Throwable;

class GetCarDetailsService {

    /** @var HttpClientInterface $client */
    private $client;

    public function __construct()
    {
        $this->client = HttpClient::create(['http_version' => '2.0']);
    }

    /**
     * @param int $carId
     *
     * @return array
     */
    public function execute($carId): array
    {
        $apiUrl = "https://www.classic-trader.com/api/vehicle-ad/$carId.json";
        $response = $this->getResponse($apiUrl);

        return $this->getData($response);
    }

    /**
     * @param string $apiUrl
     * @param string $method
     *
     * @return ResponseInterface
     */
    private function getResponse(string $apiUrl, $method = 'GET'): ResponseInterface
    {
        try {
            return $this->client->request('GET', $apiUrl);
        } catch (Throwable $e) {
            throw new Exception('Server Error');
        }
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array
     */
    private function getContent(ResponseInterface $response): array
    {
        try {
            return $response->toArray();
        } catch (Throwable $e) {
            throw new Exception('Server Error');
        }
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array
     */
    private function getData(ResponseInterface $response): array
    {
        $content = $this->getContent($response);

        if ($content['success'] === true) {
            return $content['data'];
        }

        throw new Exception('Bad Request');
    }
}