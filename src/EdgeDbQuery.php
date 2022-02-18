<?php declare(strict_types=1);

namespace TeddyBear06\EdgeDbPhp;

/**
 * An EdgeDB query helper.
 */
class EdgeDbQuery {

    /**
     * EdgeDB query
     * @var string
     */
    private string $query;

    /**
     * EdgeDB query's variables
     * @var \stdClass
     */
    private \stdClass $variables;

    /**
     * Creates an EdgeDB PHP query instance
     * 
     * @var string $query The query (see https://www.edgedb.com/docs/edgeql/index)
     * @var array $variables The variables required by your query
     */
    public function __construct(string $query, array $variables = [])
    {
        $this->query = $query;
        $this->variables = (Object) $variables;
    }

    /**
     * Generate an array with required EdgeDB fields.
     * 
     * @return array
     */
    public function getQuery(): array
    {
        return [
            'query' => $this->query,
            'variables' => $this->variables
        ];
    }

}