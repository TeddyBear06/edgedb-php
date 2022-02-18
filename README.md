# Unofficial EdgeDB PHP client

Not - yet - ready for production as it needs review from the community.

## Quickstart

Add this package to your project:

```bash
$ composer require teddybear06/edgedb-php
```

Require Composer's autoloader (if it's not already done):

```php
require 'vendor/autoload.php';
```

Require two needed classes:

```php
use TeddyBear06\EdgeDbPhp\EdgeDbClient;
use TeddyBear06\EdgeDbPhp\EdgeDbQuery;
```

Create an new EdgeDbClient with your EdgeDB server configuration:

```php
$edgeDbClient = new EdgeDbClient('127.0.0.1', '10700', 'edgedb');
```

Create an EdgeDbQuery:

```php
$edgeDbQuery = new EdgeDbQuery('select Author {firstname} filter .firstname = <str>$firstname;', ['firstname' => 'John']);
```

Get the response:

```php
$edgeDbResponse = $edgeDbClient->send($edgeDbQuery);
```

Use the response with your own logic:

```php
if (isset($edgeDbResponse['data'])) {
    echo $edgeDbResponse['data'][0]['firstname'];
} else {
    echo 'No matches...';
}
```

## Debug

If needed, you can set an extra parameter to the EdgeDbClient constructor like so:

```php
$edgeDbClient = new EdgeDbClient('127.0.0.1', '10700', 'edgedb', true);
```

You will get an extra response index 'debug' and it will activate Guzzle debug mode:

```php
var_dump($edgeDbResponse['debug']);
```