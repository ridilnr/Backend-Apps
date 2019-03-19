<?php
use Phalcon\Http\Response;
// -------------------------- POST AN OLD ORDER SUMMARY --------------------------
$app->post('/api/v1/oldordersummaries', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $oldordsum = $app->request->getJsonRawBody();

    $phqlCheckId = 'SELECT id FROM Oldordersummary WHERE id = :id:';

    $oldrderCheckId = $app->modelsManager->executeQuery(
        $phqlCheckId,
        [
            'id' => $oldordsum->id,
        ]
    )->getFirst();

    if((is_object($oldrderCheckId)) and ($oldrderCheckId->id === $oldordsum->id)) {
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "old order summary can not be created",
            'id' => "id must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Oldordersummary (id, ordercode, userid, restauname, orderdate, ordertime, status, totalprice, totalqty, year, 
                                          month, day, orderrating, otherinfo, reasoncanceled, reasondeleted, ordernotification) 
                  VALUES(:id:, :ordercode:, :userid:, :restauname:, :orderdate:, :ordertime:, :status:, :totalprice:, :totalqty:, :year:, 
                         :month:, :day:, :orderrating:, :otherinfo:, :reasoncanceled:, :reasondeleted:, :ordernotification:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
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
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "old order summary created successfully",
                'data' => $oldordsum,
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