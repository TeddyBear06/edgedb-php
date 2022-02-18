<?php declare(strict_types=1);

namespace TeddyBear06\EdgeDbPhp;

require __DIR__ . '/../vendor/autoload.php';

use TeddyBear06\EdgeDbPhp\EdgeDbQuery;
use PHPUnit\Framework\TestCase;

final class EdgeDbQueryTest extends TestCase
{
    public function testSimpleEdgeQueryIsValid(): void
    {
        $edgeDbQuery = new EdgeDbQuery('select Author {firstname};');

        $this->assertEquals(
            $edgeDbQuery->getQuery(),
            [
                'query' => 'select Author {firstname};',
                'variables' => (Object) []
            ]
        );
    }
}