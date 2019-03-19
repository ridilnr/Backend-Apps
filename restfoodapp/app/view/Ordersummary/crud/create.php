<?php
use Phalcon\Http\Response;
// -------------------------- POST AN ORDER SUMMARY --------------------------
$app->post('/api/v1/ordersummaries', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $ordsum = $app->request->getJsonRawBody();

    $phqlCheckId = 'SELECT id FROM Ordersummary WHERE id = :id:';

    $orderCheckId = $app->modelsManager->executeQuery(
        $phqlCheckId,
        [
            'id' => $ordsum->id,
        ]
    )->getFirst();

    if((is_object($orderCheckId)) and ($orderCheckId->id === $ordsum->id)) {
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "order summary can not be created",
            'id' => "id must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Ordersummary (id, ordercode, userid, restauname, orderdate, ordertime, status, totalprice, totalqty, year, 
                                   month, day, orderrating, otherinfo, reasoncanceled, reasondeleted, ordernotification) 
                  VALUES(:id:, :ordercode:, :userid:, :restauname:, :orderdate:, :ordertime:, :status:, :totalprice:, :totalqty:, :year:, 
                          :month:, :day:, :orderrating:, :otherinfo:, :reasoncanceled:, :reasondeleted:, :ordernotification:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
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
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "order summary created successfully",
                'data' => $ordsum,
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
        } else {
            // Change the HTTP status
            $response->setStatusCode(409, 'Conflict');

            // Send errors to the client
            $errors = [];

            foreach ($status->getMessages() as $message) {
                $errors[] = $message->getMessage();
            }

            $response->setJsonContent(
                [
                    'status' => 'error',
                    'messages' => $errors,
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
                ]
            );
        }
    }
    // third
    return $response;
});