<?php declare(strict_types=1);

namespace TeddyBear06\EdgeDbPhp;

/**
 * An EdgeQL query helper.
 */
class EdgeQlQuery
{

    /**
     * EdgeQL query
     * 
     * @var string
     */
    private string $query;

    /**
     * EdgeQL query's variables
     * 
     * @var \stdClass
     */
    private \stdClass $variables;

    /**
     * Creates an EdgeQL query instance
     * 
     * @var string $query The query (see https://www.edgedb.com/docs/edgeql/index)
     * @var array $variables The query's variables
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