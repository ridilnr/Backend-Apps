<?php
use Phalcon\Http\Response;
// -------------------------- UPDATE AN OLD ORDER SUMMARY --------------------------
$app->put('/api/v1/oldordersummaries/{id}', function ($id) use ($app) {
    // first
    $oldordsum = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Oldordersummary WHERE id = :id:";

    $oldordersumCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'id' => $id
        ]
    )->getFirst();

    if($oldordersumCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "old order summary with id : ".$id." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Oldordersummary SET ordercode = :ordercode:, userid = :userid:, restauname = :restauname:, orderdate = :orderdate:, ordertime = :ordertime:, status = :status:, 
                                            totalprice = :totalprice:, totalqty = :totalqty:, year = :year:, month = :month:, day = :day:, orderrating = :orderrating:, 
                                            otherinfo = :otherinfo:, reasoncanceled = :reasoncanceled:, reasondeleted = :reasondeleted:, ordernotification = :ordernotification:  
                  WHERE id = :id:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				    =>	$id,
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