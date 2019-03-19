<?php
use Phalcon\Http\Response;
// -------------------------- GET ALL CITIES --------------------------
$app->get('/api/v1/cities', function () use ($app) {
    // first
    $phql = "SELECT * FROM Cities ORDER BY cityid";

    $cities = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($cities) !== 0){
        foreach($cities as $city) {
            $data[] = [
                'cityid'				    =>	$city->cityid,
                'cityname'		            =>	$city->cityname,
                'countryname'			    =>	$city->countryname,
                'description'	            =>	$city->description,
                'otherinfo'	                =>	$city->otherinfo,
                'status'			        =>	$city->status
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'cities exist',
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
            'status' => 'error',
            'messages' => 'cities don\'t exist',
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

// -------------------------- GET A CITY --------------------------
$app->get('/api/v1/cities/{cityid}', function ($cityid) use ($app) {
    // first
    $phql = "SELECT * FROM Cities WHERE cityid = :cityid:";

    $city = $app->modelsManager->executeQuery(
        $phql,
        [
            'cityid' => $cityid
        ]
    )->getFirst();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if($city === false){
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "city with cityid : ".$cityid." doesn't exist",
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
            'messages' => "city with cityid : ".$cityid." exists",
            'data' => [
                'cityid'				    =>	$city->cityid,
                'cityname'		            =>	$city->cityname,
                'countryname'			    =>	$city->countryname,
                'description'	            =>	$city->description,
                'otherinfo'	                =>	$city->otherinfo,
                'status'			        =>	$city->status
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
