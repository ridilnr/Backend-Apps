<?php
use Phalcon\Http\Response;
// -------------------------- GET ALL FOODS OF ALL RESTAURANTS --------------------------
$app->get('/api/v1/foods', function () use ($app) {
    // first
    $phql = "SELECT * FROM Foods ORDER BY foodid";

    $foods = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($foods) !== 0){
        foreach($foods as $food) {
            $data[] = [
                'foodid'				    =>	$food->foodid,
                'restoid'		            =>	$food->restoid,
                'restauname'			    =>	$food->restauname,
                'foodname'	                =>	$food->foodname,
                'photo'	                    =>	$food->photo,
                'price'			            =>	$food->price,
                'pricesmall'			    =>	$food->pricesmall,
                'pricemedium'			    =>	$food->pricemedium,
                'pricebig'			        =>	$food->pricebig,
                'description'		        =>	$food->description,
                'type'			            =>	$food->type,
                'available'	                =>	$food->available,
                'dateinserted'	            =>	$food->dateinserted,
                'lastupdateddate'		    =>	$food->lastupdateddate,
                'discount'		            =>	$food->discount,
                'size'		                =>	$food->size
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'foods exist',
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
            'messages' => 'foods don\'t exist',
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
// -------------------------- GET ALL FOODS OF A RESTAURANT --------------------------
$app->get('/api/v1/restaurant/foods/{restoid}', function ($restoid) use ($app) {
    // first
    $phql = "SELECT * FROM Foods WHERE restoid = :restoid:  ORDER BY foodid";


    $foods = $app->modelsManager->executeQuery(
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

    if(sizeof($foods) !== 0){
        foreach($foods as $food) {
            $data[] = [
                'foodid'				    =>	$food->foodid,
                'restoid'		            =>	$food->restoid,
                'restauname'			    =>	$food->restauname,
                'foodname'	                =>	$food->foodname,
                'photo'	                    =>	$food->photo,
                'price'			            =>	$food->price,
                'pricesmall'			    =>	$food->pricesmall,
                'pricemedium'			    =>	$food->pricemedium,
                'pricebig'			        =>	$food->pricebig,
                'description'		        =>	$food->description,
                'type'			            =>	$food->type,
                'available'	                =>	$food->available,
                'dateinserted'	            =>	$food->dateinserted,
                'lastupdateddate'		    =>	$food->lastupdateddate,
                'discount'		            =>	$food->discount,
                'size'		                =>	$food->size
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'foods exist',
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
            'messages' => 'foods don\'t exist',
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
// -------------------------- GET A FOOD --------------------------
$app->get('/api/v1/foods/{foodid}', function ($foodid) use ($app) {
    // first
    $phql = "SELECT * FROM Foods WHERE foodid = :foodid:";

    $food = $app->modelsManager->executeQuery(
        $phql,
        [
            'foodid' => $foodid
        ]
    )->getFirst();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if($food === false){
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "food with foodid : ".$foodid." doesn't exist",
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
            'messages' => "food with foodid : ".$foodid." exists",
            'data' => [
                'foodid'				    =>	$food->foodid,
                'restoid'		            =>	$food->restoid,
                'restauname'			    =>	$food->restauname,
                'foodname'	                =>	$food->foodname,
                'photo'	                    =>	$food->photo,
                'price'			            =>	$food->price,
                'pricesmall'			    =>	$food->pricesmall,
                'pricemedium'			    =>	$food->pricemedium,
                'pricebig'			        =>	$food->pricebig,
                'description'		        =>	$food->description,
                'type'			            =>	$food->type,
                'available'	                =>	$food->available,
                'dateinserted'	            =>	$food->dateinserted,
                'lastupdateddate'		    =>	$food->lastupdateddate,
                'discount'		            =>	$food->discount,
                'size'		                =>	$food->size
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