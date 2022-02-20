# Unofficial EdgeDB HTTP PHP client

## Requirements

- PHP >= 8.0 (with fileinfo and mbstring)
- An EdgeDB server instance (tested with 1.0+9ecadfc) 

## Quickstart

Add this package to your project:

```bash
$ composer require teddybear06/edgedb-php
```

This is a complete usage example (or look at https://github.com/TeddyBear06/edgedb-php/tree/main/example/index.php):

```php
// Require Composer's autoloader 
require '/vendor/autoload.php';

// Use required classes
use TeddyBear06\EdgeDbPhp\EdgeDbHttpClient;
use TeddyBear06\EdgeDbPhp\EdgeQlQuery;

// Establish a connection with the EdgeDB server instance
$connection = new EdgeDbHttpClient('127.0.0.1', '10700', 'edgedb');

// Create an EdgeQL query
$query = new EdgeQlQuery(
    'select Author {firstname, lastname} filter .lastname = <str>$lastname;', 
    ['lastname' => 'Doe']
);

// Execute the query
$response = $connection->query($query);

// If there is no error message
if (is_null($response->getError())) {

    // If there is at least 1 result
    if ($response->countData() > 0) {

        // Loop over results
        foreach ($response->getData() as $data) {
            echo $data['prenom'];
        }

    } else {

        // Data set is empty
        echo 'No matches found...';

    }

} else {

    // Call $response->getError() to get error details
    // message, type or code array indexes are available
    echo $response->getError()['message'];

}
```

## Documentation

For a complete API documentation, please go here : [https://teddybear06.github.io/edgedb-php/](https://teddybear06.github.io/edgedb-php/)