<?php
use Phalcon\Http\Response;
// -------------------------- UPDATE AN ORDER SUMMARY --------------------------
$app->put('/api/v1/ordersummaries/{id}', function ($id) use ($app) {
    // first
    $ordsum = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Ordersummary WHERE id = :id:";

    $ordersumCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'id' => $id
        ]
    )->getFirst();

    if($ordersumCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "order summary with id : ".$id." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Ordersummary SET ordercode = :ordercode:, userid = :userid:, restauname = :restauname:, orderdate = :orderdate:, ordertime = :ordertime:, status = :status:, 
                                         totalprice = :totalprice:, totalqty = :totalqty:, year = :year:, month = :month:, day = :day:, orderrating = :orderrating:, 
                                         otherinfo = :otherinfo:, reasoncanceled = :reasoncanceled:, reasondeleted = :reasondeleted:, ordernotification = :ordernotification:  
                  WHERE id = :id:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				    =>	$id,
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
            $response->setStatusCode(204, 'No Content');
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
                            'rel' => '',
                            'href' => '',
                            'type' => ''
                        ],
                    ]
                ]
            );
        }
    }
    // third
    return $response;
});