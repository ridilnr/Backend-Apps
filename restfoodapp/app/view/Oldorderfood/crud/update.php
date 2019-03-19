<?php
use Phalcon\Http\Response;
// -------------------------- UPDATE AN OLD FOOD ORDER --------------------------
$app->put('/api/v1/oldorderfoods/{orderid}', function ($orderid) use ($app) {
    // first
    $orderFood = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Oldorderfood WHERE orderid = :orderid:";

    $orderCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'orderid' => $orderid
        ]
    )->getFirst();

    if($orderCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "old food order with orderid : ".$orderid." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Oldorderfood SET orderdate = :orderdate:,  ordertime = :ordertime:, expectedtime = :expectedtime:, afterminutes = :afterminutes:, status = :status:, 
                                         restauname = :restauname:, foodid = :foodid:, foodname = :foodname:, foodprice = :foodprice:, foodpricesmall = :foodpricesmall:, 
										 foodpricemedium = :foodpricemedium:, foodpricebig = :foodpricebig:, foodqty = :foodqty:, userid = :userid:, orderyear = :orderyear:, 
										 ordermonth = :ordermonth:, orderday = :orderday:, ordercode = :ordercode: 
                  WHERE orderid = :orderid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'orderid'				    =>	$orderid,
                'orderdate'		            =>	$orderFood->orderdate,
                'ordertime'			        =>	$orderFood->ordertime,
                'expectedtime'	            =>	$orderFood->expectedtime,
                'afterminutes'	            =>	$orderFood->afterminutes,
                'status'			        =>	$orderFood->status,
                'restauname'		        =>	$orderFood->restauname,
                'foodid'		            =>	$orderFood->foodid,
                'foodname'		            =>	$orderFood->foodname,
                'foodprice'		            =>	$orderFood->foodprice,
                'foodpricesmall'		    =>	$orderFood->foodpricesmall,
                'foodpricemedium'		    =>	$orderFood->foodpricemedium,
                'foodpricebig'		    	=>	$orderFood->foodpricebig,
                'foodqty'		            =>	$orderFood->foodqty,
                'userid'		            =>	$orderFood->userid,
                'orderyear'		            =>	$orderFood->orderyear,
                'ordermonth'		        =>	$orderFood->ordermonth,
                'orderday'		            =>	$orderFood->orderday,
                'ordercode'		            =>	$orderFood->ordercode,
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