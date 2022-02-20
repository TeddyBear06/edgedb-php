<?php

// Require Composer's autoloader 
require __DIR__ .'/../vendor/autoload.php';

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