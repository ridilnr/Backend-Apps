<?php
use Phalcon\Http\Response;
// -------------------------- GET ALL RESTAURANTS ADMINISTRATORS --------------------------
$app->get('/api/v1/adminrestaurants', function () use ($app) {
    // first
    $phql = 'SELECT * FROM Adminrestaurant ORDER BY idresto';

    $adminrestaurants = $app->modelsManager->executeQuery($phql);

    $data = [];

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($adminrestaurants)){
        foreach($adminrestaurants as $adminrestaurant) {
            $data[] = [
                'idresto'				    =>	$adminrestaurant->idresto,
                'email'	                    =>	$adminrestaurant->email,
                'username'	                =>	$adminrestaurant->username,
                'password'			        =>	$adminrestaurant->password,
                'status'		            =>	$adminrestaurant->status,
                'type'			            =>	$adminrestaurant->type,
                'pwupdatecode'	            =>	$adminrestaurant->pwupdatecode,
                'pwupdatelink'	            =>	$adminrestaurant->pwupdatelink,
                'datecreation'		        =>	$adminrestaurant->datecreation,
                'lastupdatedate'		    =>	$adminrestaurant->lastupdatedate,
                'lastlogindate'		        =>	$adminrestaurant->lastlogindate,
                'description'		        =>	$adminrestaurant->description,
                'otherinfo'		            =>	$adminrestaurant->otherinfo,
                'datebirth'		            =>	$adminrestaurant->datebirth,
                'gender'		            =>	$adminrestaurant->gender,
                'phonenumber'		        =>	$adminrestaurant->phonenumber,
                'restauname'		        =>	$adminrestaurant->restauname,
                'city'		                =>	$adminrestaurant->city,
                'country'		            =>	$adminrestaurant->country,
                'deliverystarttime'		    =>	$adminrestaurant->deliverystarttime,
                'deliverystoptime'		    =>	$adminrestaurant->deliverystoptime,
                'photo'		                =>	$adminrestaurant->photo,
                'address'		            =>	$adminrestaurant->address,
                'connectivity'		        =>	$adminrestaurant->connectivity,
                'restorate'		            =>	$adminrestaurant->restorate,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'restaurants administrators exist',
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
            'messages' => 'restaurants administrators don\'t exist',
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

// -------------------------- GET A RESTAURANT ADMINISTRATOR --------------------------
$app->get('/api/v1/adminrestaurants/{idresto}', function ($idresto) use ($app) {
    // first
    $phql = 'SELECT * FROM Adminrestaurant WHERE idresto = :idresto:';

    $adminrestaurant = $app->modelsManager->executeQuery(
        $phql,
        [
            'idresto' => $idresto
        ]
    )->getFirst();

    $data = [];

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if($adminrestaurant === false) {
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "restaurant administrator with idresto : ".$idresto." doesn't exist",
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
            'messages' => "restaurant administrator with idresto : ".$idresto."  exists",
            'data' => [
                'idresto'				    =>	$adminrestaurant->idresto,
                'email'	                    =>	$adminrestaurant->email,
                'username'	                =>	$adminrestaurant->username,
                'password'			        =>	$adminrestaurant->password,
                'status'		            =>	$adminrestaurant->status,
                'type'			            =>	$adminrestaurant->type,
                'pwupdatecode'	            =>	$adminrestaurant->pwupdatecode,
                'pwupdatelink'	            =>	$adminrestaurant->pwupdatelink,
                'datecreation'		        =>	$adminrestaurant->datecreation,
                'lastupdatedate'		    =>	$adminrestaurant->lastupdatedate,
                'lastlogindate'		        =>	$adminrestaurant->lastlogindate,
                'description'		        =>	$adminrestaurant->description,
                'otherinfo'		            =>	$adminrestaurant->otherinfo,
                'datebirth'		            =>	$adminrestaurant->datebirth,
                'gender'		            =>	$adminrestaurant->gender,
                'phonenumber'		        =>	$adminrestaurant->phonenumber,
                'restauname'		        =>	$adminrestaurant->restauname,
                'city'		                =>	$adminrestaurant->city,
                'country'		            =>	$adminrestaurant->country,
                'deliverystarttime'		    =>	$adminrestaurant->deliverystarttime,
                'deliverystoptime'		    =>	$adminrestaurant->deliverystoptime,
                'photo'		                =>	$adminrestaurant->photo,
                'address'		            =>	$adminrestaurant->address,
                'connectivity'		        =>	$adminrestaurant->connectivity,
                'restorate'		            =>	$adminrestaurant->restorate,
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