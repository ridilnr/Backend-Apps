<?php
use Phalcon\Http\Response;
// -------------------------- GET ALL CUSTOMERS --------------------------
$app->get('/api/v1/customers', function () use ($app) {
    // first
    $phql = "SELECT * FROM Customers ORDER BY id";

    $customers = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($customers) !== 0){
        foreach($customers as $customer) {
            $data[] = [
                'id'				        =>	$customer->id,
                'userid'		            =>	$customer->userid,
                'fullname'			        =>	$customer->fullname,
                'email'			            =>	$customer->email,
                'phonenumber'			    =>	$customer->phonenumber,
                'city'			            =>	$customer->city,
                'address'			        =>	$customer->address,
                'idresto'			        =>	$customer->idresto,
                'photo'			            =>	$customer->photo,
                'customerrating'			=>	$customer->customerrating,
                'restorating'			    =>	$customer->restorating,
                'restocomments'			    =>	$customer->restocomments,
                'otherinfo'			        =>	$customer->otherinfo,
                'allownotifications'		=>	$customer->allownotifications,
                'membershipdate'			=>	$customer->membershipdate,
				'status'					=>	$customer->status,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'customers exist',
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
            'messages' => 'customers don\'t exist',
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
// -------------------------- GET A CUSTOMER --------------------------
$app->get('/api/v1/customers/{id}', function ($id) use ($app) {
    // first
    $phql = "SELECT * FROM Customers WHERE id = :id:";

    $customer = $app->modelsManager->executeQuery(
        $phql,
        [
            'id' => $id
        ]
    )->getFirst();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if($customer === false){
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "customer with id : ".$id." doesn't exist",
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
            'messages' => "customer with id : ".$id." exists",
            'data' => [
                'id'				        =>	$customer->id,
                'userid'		            =>	$customer->userid,
                'fullname'			        =>	$customer->fullname,
                'email'			            =>	$customer->email,
                'phonenumber'			    =>	$customer->phonenumber,
                'city'			            =>	$customer->city,
                'address'			        =>	$customer->address,
                'idresto'			        =>	$customer->idresto,
                'photo'			            =>	$customer->photo,
                'customerrating'			=>	$customer->customerrating,
                'restorating'			    =>	$customer->restorating,
                'restocomments'			    =>	$customer->restocomments,
                'otherinfo'			        =>	$customer->otherinfo,
                'allownotifications'		=>	$customer->allownotifications,
                'membershipdate'			=>	$customer->membershipdate,
				'status'					=>	$customer->status,
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
    return $response;
});