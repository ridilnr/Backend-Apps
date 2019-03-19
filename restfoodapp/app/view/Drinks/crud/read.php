<?php
use Phalcon\Http\Response;
// -------------------------- GET ALL DRINKS --------------------------
$app->get('/api/v1/drinks', function () use ($app) {
    // first
    $phql = "SELECT * FROM Drinks ORDER BY drinkid";

    $drinks = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($drinks) !== 0){
        foreach($drinks as $drink) {
            $data[] = [
                'drinkid'				    =>	$drink->drinkid,
                'restoid'		            =>	$drink->restoid,
                'restauname'			    =>	$drink->restauname,
                'drinkname'	                =>	$drink->drinkname,
                'type'			            =>	$drink->type,
                'price'			            =>	$drink->price,
                'available'	                =>	$drink->available,
                'dateinserted'	            =>	$drink->dateinserted,
                'lastupdateddate'		    =>	$drink->lastupdateddate,
                'discount'		            =>	$drink->discount,
                'description'		        =>	$drink->description,
                'size'		                =>	$drink->size,
                'photo'	                    =>	$drink->photo
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'drinks exist',
            'data' => $data,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'GET',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'GET',
                    'record' => 'multiple'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'POST',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'UPDATE',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'DELETE',
                    'record' => 'single'
                ],
            ]

        ]);
    }else {
        $response->setJsonContent([
            'status' => 'error',
            'messages' => 'drinks don\'t exist',
            'data' => $data,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'GET',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'GET',
                    'record' => 'multiple'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'POST',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'UPDATE',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'DELETE',
                    'record' => 'single'
                ],
            ]

        ]);
    }
    // third
    return $response;
});
// -------------------------- GET ALL DRINKS OF A RESTAURANT --------------------------
$app->get('/api/v1/restaurant/drinks/{restoid}', function ($restoid) use ($app) {
    // first
    $phql = "SELECT * FROM Drinks WHERE restoid = :restoid: ORDER BY drinkid";

    $drinks = $app->modelsManager->executeQuery(
        $phql,
        [
            'restoid' => $restoid
        ]
    );

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($drinks) !== 0){
        foreach($drinks as $drink) {
            $data[] = [
                'drinkid'				    =>	$drink->drinkid,
                'restoid'		            =>	$drink->restoid,
                'restauname'			    =>	$drink->restauname,
                'drinkname'	                =>	$drink->drinkname,
                'type'			            =>	$drink->type,
                'price'			            =>	$drink->price,
                'available'	                =>	$drink->available,
                'dateinserted'	            =>	$drink->dateinserted,
                'lastupdateddate'		    =>	$drink->lastupdateddate,
                'discount'		            =>	$drink->discount,
                'description'		        =>	$drink->description,
                'size'		                =>	$drink->size,
                'photo'	                    =>	$drink->photo
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'drinks exist',
            'data' => $data,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'GET',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'GET',
                    'record' => 'multiple'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'POST',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'UPDATE',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'DELETE',
                    'record' => 'single'
                ],
            ]

        ]);
    }else {
        $response->setJsonContent([
            'status' => 'error',
            'messages' => 'drinks don\'t exist',
            'data' => $data,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'GET',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'GET',
                    'record' => 'multiple'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'POST',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'UPDATE',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'DELETE',
                    'record' => 'single'
                ],
            ]

        ]);
    }
    // third
    return $response;
});
// -------------------------- GET A DRINK --------------------------
$app->get('/api/v1/drinks/{drinkid}', function ($drinkid) use ($app) {
    // first
    $phql = "SELECT * FROM Drinks WHERE drinkid = :drinkid:";

    $drink = $app->modelsManager->executeQuery(
        $phql,
        [
            'drinkid' => $drinkid
        ]
    )->getFirst();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if($drink === false){
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "drink with drinkid : ".$drinkid." doesn't exist",
            'data' => $data,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'GET',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'GET',
                    'record' => 'multiple'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'POST',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'UPDATE',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'DELETE',
                    'record' => 'single'
                ],
            ]

        ]);
    }else{
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "drink with drinkid : ".$drinkid." exists",
            'data' => [
                'drinkid'				    =>	$drink->drinkid,
                'restoid'		            =>	$drink->restoid,
                'restauname'			    =>	$drink->restauname,
                'drinkname'	                =>	$drink->drinkname,
                'type'			            =>	$drink->type,
                'price'			            =>	$drink->price,
                'available'	                =>	$drink->available,
                'dateinserted'	            =>	$drink->dateinserted,
                'lastupdateddate'		    =>	$drink->lastupdateddate,
                'discount'		            =>	$drink->discount,
                'description'		        =>	$drink->description,
                'size'		                =>	$drink->size,
                'photo'	                    =>	$drink->photo
            ],
            'links' => [
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'GET',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'GET',
                    'record' => 'multiple'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'POST',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'UPDATE',
                    'record' => 'single'
                ],
                [
                    'rel' => 'self',
                    'href' => '/api/v1/',
                    'method' => 'DELETE',
                    'record' => 'single'
                ],
            ]

        ]);
    }
    // third
    return $response;
});