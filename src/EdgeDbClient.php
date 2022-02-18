<?php declare(strict_types=1);

namespace TeddyBear06\EdgeDbPhp;

use TeddyBear06\EdgeDbPhp\EdgeDbQuery;
use GuzzleHttp\Client;

/**
 * An unofficial naive EdgeDB PHP client using EdgeDB HTTP protocol.
 * 
 * See https://www.edgedb.com/docs/clients/90_edgeql/index for more informations about
 * how to activate it on your EdgeDB instance.
 */
class EdgeDbClient {

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
     * @var bool $debug Indicates whether or not the client should display debug infos.
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
     * Send an HTTP request against an EdgeDB server instance.
     * 
     * @var EdgeDbQuery $query The EdgeDB query.
     * @return array
     */
    public function send(EdgeDbQuery $query): array
    {
        $options = [
            'json' => $query->getQuery(),
            'debug' => $this->debug
        ];

        $response = $this->client->request('POST', '', $options);

        $body = $response->getBody();

        $json = json_decode($body->__toString(), true);

        if ($this->debug) {
            $json['debug'] = [
                'jsonQuery' => $query->getQuery()
            ];
        }

        return $json;
    }

}