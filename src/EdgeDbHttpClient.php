<?php declare(strict_types=1);

namespace TeddyBear06\EdgeDbPhp;

use TeddyBear06\EdgeDbPhp\EdgeDbHttpResponse;
use TeddyBear06\EdgeDbPhp\EdgeQlQuery;
use GuzzleHttp\Client;

/**
 * An unofficial EdgeDB PHP client using EdgeDB HTTP protocol.
 * 
 * See https://www.edgedb.com/docs/clients/90_edgeql/index for more informations about
 * how to activate it on your EdgeDB instance.
 */
class EdgeDbHttpClient
{

    /**
     * EdgeDB hostname (or IP).
     * 
     * @var string
     */
    private string $hostname;

    /**
     * EdgeDB port.
     * 
     * @var integer
     */
    private int $port;

    /**
     * EdgeDB database name.
     * 
     * @var string
     */
    private string $database;

    /**
     * Indicates whether or not the client should display debug infos.
     * 
     * @var bool
     */
    private bool $debug;

    /**
     * Guzzle client.
     * 
     * @var Client
     */
    private $client;

    /**
     * Creates an EdgeDB PHP client instance.
     * 
     * @var string $hostname The EdgeDB server hostname (or IP).
     * @var int $port The EdgeDB server port.
     * @var string $database The EdgeDB database name.
     * @var bool $debug Indicates whether or not the client should display debug infos (see https://docs.guzzlephp.org/en/stable/request-options.html#debug).
     */
    public function __construct(string $hostname = '127.0.0.1', int $port = 10700, string $database = 'edgedb', bool $debug = false)
    {
        $this->hostname = $hostname;
        $this->port = $port;
        $this->database = $database;
        $this->debug = $debug;
        $this->client = new Client([
            'base_uri' => sprintf('http://%s:%d/db/%s/edgeql', $this->hostname, $this->port, $this->database)
        ]);
    }

    /**
     * Send an HTTP query against an EdgeDB server instance.
     * 
     * @var EdgeQlQuery $query The EdgeQL query.
     * 
     * @return EdgeDbHttpResponse
     */
    public function query(EdgeQlQuery $query): EdgeDbHttpResponse
    {
        $options = [
            'json' => $query->getQuery(),
            'debug' => $this->debug
        ];

        $response = $this->client->request('POST', '', $options);
        
        return new EdgeDbHttpResponse($response->getBody());
    }

}