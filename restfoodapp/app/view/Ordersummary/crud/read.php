<?php
use Phalcon\Http\Response;
// -------------------------- GET ALL ORDER SUMMARY --------------------------
$app->get('/api/v1/ordersummaries', function () use ($app) {
    // first
    $phql = "SELECT * FROM Ordersummary ORDER BY id";

    $ordersummary = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($ordersummary) !== 0){
        foreach($ordersummary as $ordsum) {
            $data[] = [
                'id'				    =>	$ordsum->id,
                'ordercode'		        =>	$ordsum->ordercode,
                'userid'		        =>	$ordsum->userid,
                'restauname'			=>	$ordsum->restauname,
                'orderdate'	            =>	$ordsum->orderdate,
                'ordertime'	            =>	$ordsum->ordertime,
                'status'			    =>	$ordsum->status,
                'totalprice'		    =>	$ordsum->totalprice,
                'totalqty'			    =>	$ordsum->totalqty,
                'year'	                =>	$ordsum->year,
                'month'	                =>	$ordsum->month,
                'day'		            =>	$ordsum->day,
                'orderrating'		    =>	$ordsum->orderrating,
                'otherinfo'		        =>	$ordsum->otherinfo,
                'reasoncanceled'		=>	$ordsum->reasoncanceled,
                'reasondeleted'		    =>	$ordsum->reasondeleted,
                'ordernotification'		=>	$ordsum->ordernotification,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'orders summary exist',
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
            'messages' => 'orders summary don\'t exist',
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
// -------------------------- GET ALL ORDER SUMMARY OF A USER --------------------------
$app->get('/api/v1/user/ordersummaries/{userid}', function ($userid) use ($app) {
    // first
    $phql = "SELECT * FROM Ordersummary WHERE userid = :userid: ORDER BY id";

    $ordersummary = $app->modelsManager->executeQuery(
        $phql,
        [
            'userid' => $userid,
        ]
    );

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($ordersummary) !== 0){
        foreach($ordersummary as $ordsum) {
            $data[] = [
                'id'				    =>	$ordsum->id,
                'ordercode'		        =>	$ordsum->ordercode,
                'userid'		        =>	$ordsum->userid,
                'restauname'			=>	$ordsum->restauname,
                'orderdate'	            =>	$ordsum->orderdate,
                'ordertime'	            =>	$ordsum->ordertime,
                'status'			    =>	$ordsum->status,
                'totalprice'		    =>	$ordsum->totalprice,
                'totalqty'			    =>	$ordsum->totalqty,
                'year'	                =>	$ordsum->year,
                'month'	                =>	$ordsum->month,
                'day'		            =>	$ordsum->day,
                'orderrating'		    =>	$ordsum->orderrating,
                'otherinfo'		        =>	$ordsum->otherinfo,
                'reasoncanceled'		=>	$ordsum->reasoncanceled,
                'reasondeleted'		    =>	$ordsum->reasondeleted,
                'ordernotification'		=>	$ordsum->ordernotification,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "orders summary of user with userid = $userid exist",
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
            'messages' => "orders summary of user with userid = $userid don't exist",
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
// -------------------------- GET AN ORDER SUMMARY --------------------------
$app->get('/api/v1/ordersummaries/{id}', function ($id) use ($app) {
    // first
    $phql = "SELECT * FROM Ordersummary WHERE id = :id:";

    $ordsum = $app->modelsManager->executeQuery(
        $phql,
        [
            'id' => $id
        ]
    )->getFirst();

    $response = new Response();

    // second
    $data = [];

    if($ordsum === false){
        $response->setHeader('Content-Type', 'application/json');
        $response->setStatusCode(200, 'OK');
        $response->setJsonContent([
            'status' => 'failed',
            'messages' => "order summary with id : ".$id." doesn't exist",
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
        $response->setHeader('Content-Type', 'application/json');
        $response->setStatusCode(200, 'OK');
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "order summary with id : ".$id." exists",
            'data' => [
                'id'				    =>	$ordsum->id,
                'ordercode'		        =>	$ordsum->ordercode,
                'userid'		        =>	$ordsum->userid,
                'restauname'			=>	$ordsum->restauname,
                'orderdate'	            =>	$ordsum->orderdate,
                'ordertime'	            =>	$ordsum->ordertime,
                'status'			    =>	$ordsum->status,
                'totalprice'		    =>	$ordsum->totalprice,
                'totalqty'			    =>	$ordsum->totalqty,
                'year'	                =>	$ordsum->year,
                'month'	                =>	$ordsum->month,
                'day'		            =>	$ordsum->day,
                'orderrating'		    =>	$ordsum->orderrating,
                'otherinfo'		        =>	$ordsum->otherinfo,
                'reasoncanceled'		=>	$ordsum->reasoncanceled,
                'reasondeleted'		    =>	$ordsum->reasondeleted,
                'ordernotification'		=>	$ordsum->ordernotification,
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