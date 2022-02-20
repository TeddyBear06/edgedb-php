<?php declare(strict_types=1);

namespace TeddyBear06\EdgeDbPhp;

use TeddyBear06\EdgeDbPhp\EdgeDbException;
use Psr\Http\Message\StreamInterface;

/**
 * Represent an EdgeDB HTTP response.
 */
class EdgeDbHttpResponse
{

    /**
     * Contain EdgeDB data.
     * 
     * @var array
     */
    private $data;

    /**
     * Contain EdgeDB errors
     * 
     * @var array|null
     */
    private $error;

    /**
     * Creates an EdgeDB HTTP response instance
     * 
     * @var StreamInterface The HTTP stream response.
     * @var bool Indicates whether the response should contain debug informations.
     * 
     * @throws EdgeDbException If an error happens while processing the response.
     */
    public function __construct(StreamInterface $body)
    {
        try {
            $response = json_decode((string) $body, true);
            $this->data = $response['data'] ?? null;
            $this->error = $response['error'] ?? null;
        } catch (\Exception $e) {
            throw new EdgeDbException('EdgeDB HTTP response instantiation failed', $e->getCode(), $e);
        }
    }

    /**
     * Get EdgeDB response data
     * 
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get EdgeDB response error
     * 
     * @return array
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Count the number of data results.
     * 
     * @return int
     */
    public function countData()
    {
        return is_array($this->data) ? count($this->data) : 0;
    }

}