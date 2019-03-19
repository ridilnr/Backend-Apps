<?php
use Phalcon\Http\Response;
// -------------------------- GET ALL OLD ORDERS SUMMARY --------------------------
$app->get('/api/v1/oldordersummaries', function () use ($app) {
    // first
    $phql = "SELECT * FROM Oldordersummary ORDER BY id";

    $oldordersummary = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($oldordersummary) !== 0){
        foreach($oldordersummary as $oldordsum) {
            $data[] = [
                'id'				    =>	$oldordsum->id,
                'ordercode'		        =>	$oldordsum->ordercode,
                'userid'		        =>	$oldordsum->userid,
                'restauname'			=>	$oldordsum->restauname,
                'orderdate'	            =>	$oldordsum->orderdate,
                'ordertime'	            =>	$oldordsum->ordertime,
                'status'			    =>	$oldordsum->status,
                'totalprice'		    =>	$oldordsum->totalprice,
                'totalqty'			    =>	$oldordsum->totalqty,
                'year'	                =>	$oldordsum->year,
                'month'	                =>	$oldordsum->month,
                'day'		            =>	$oldordsum->day,
                'orderrating'		    =>	$oldordsum->orderrating,
                'otherinfo'		        =>	$oldordsum->otherinfo,
                'reasoncanceled'		=>	$oldordsum->reasoncanceled,
                'reasondeleted'		    =>	$oldordsum->reasondeleted,
                'ordernotification'		=>	$oldordsum->ordernotification,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'old orders summary exist',
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
            'messages' => 'old orders summary don\'t exist',
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
// -------------------------- GET ALL OLD ORDERS SUMMARY OF A USER --------------------------
$app->get('/api/v1/user/oldordersummaries/{userid}', function ($userid) use ($app) {
    // first
    $phql = "SELECT * FROM Oldordersummary WHERE userid = :userid: ORDER BY id";

    $oldordersummary = $app->modelsManager->executeQuery(
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

    if(sizeof($oldordersummary) !== 0){
        foreach($oldordersummary as $oldordsum) {
            $data[] = [
                'id'				    =>	$oldordsum->id,
                'ordercode'		        =>	$oldordsum->ordercode,
                'userid'		        =>	$oldordsum->userid,
                'restauname'			=>	$oldordsum->restauname,
                'orderdate'	            =>	$oldordsum->orderdate,
                'ordertime'	            =>	$oldordsum->ordertime,
                'status'			    =>	$oldordsum->status,
                'totalprice'		    =>	$oldordsum->totalprice,
                'totalqty'			    =>	$oldordsum->totalqty,
                'year'	                =>	$oldordsum->year,
                'month'	                =>	$oldordsum->month,
                'day'		            =>	$oldordsum->day,
                'orderrating'		    =>	$oldordsum->orderrating,
                'otherinfo'		        =>	$oldordsum->otherinfo,
                'reasoncanceled'		=>	$oldordsum->reasoncanceled,
                'reasondeleted'		    =>	$oldordsum->reasondeleted,
                'ordernotification'		=>	$oldordsum->ordernotification,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "old orders summary of user with userid = $userid exist",
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
            'messages' => "old orders summary of user with userid = $userid don't exist",
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
// -------------------------- GET AN OLD ORDER SUMMARY --------------------------
$app->get('/api/v1/oldordersummaries/{id}', function ($id) use ($app) {
    // first
    $phql = "SELECT * FROM Oldordersummary WHERE id = :id:";

    $oldordsum = $app->modelsManager->executeQuery(
        $phql,
        [
            'id' => $id
        ]
    )->getFirst();

    $response = new Response();

    // second
    $data = [];

    if($oldordsum === false){
        $response->setHeader('Content-Type', 'application/json');
        $response->setStatusCode(200, 'OK');
        $response->setJsonContent([
            'status' => 'failed',
            'messages' => "old order summary with id : ".$id." doesn't exist",
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
            'messages' => "old order summary with id : ".$id." exists",
            'data' => [
                'id'				    =>	$oldordsum->id,
                'ordercode'		        =>	$oldordsum->ordercode,
                'userid'		        =>	$oldordsum->userid,
                'restauname'			=>	$oldordsum->restauname,
                'orderdate'	            =>	$oldordsum->orderdate,
                'ordertime'	            =>	$oldordsum->ordertime,
                'status'			    =>	$oldordsum->status,
                'totalprice'		    =>	$oldordsum->totalprice,
                'totalqty'			    =>	$oldordsum->totalqty,
                'year'	                =>	$oldordsum->year,
                'month'	                =>	$oldordsum->month,
                'day'		            =>	$oldordsum->day,
                'orderrating'		    =>	$oldordsum->orderrating,
                'otherinfo'		        =>	$oldordsum->otherinfo,
                'reasoncanceled'		=>	$oldordsum->reasoncanceled,
                'reasondeleted'		    =>	$oldordsum->reasondeleted,
                'ordernotification'		=>	$oldordsum->ordernotification,
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