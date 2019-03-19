<?php
use Phalcon\Http\Response;
// -------------------------- POST A FOOD ORDER --------------------------
$app->post('/api/v1/orderfoods', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $orderFood = $app->request->getJsonRawBody();

    $phqlCheckOrderId = 'SELECT orderid FROM Orderfood WHERE orderid = :orderid:';

    $orderFoodCheckId = $app->modelsManager->executeQuery(
        $phqlCheckOrderId,
        [
            'orderid' => $orderFood->orderid,
        ]
    )->getFirst();

    if((is_object($orderFoodCheckId)) and ($orderFoodCheckId->orderid === $orderFood->orderid)){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "food order can not be created",
            'orderid' => "orderid must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Orderfood (orderid, orderdate, ordertime, expectedtime, afterminutes, status, restauname, foodid, 
                                        foodname, foodprice, foodpricesmall, foodpricemedium, foodpricebig foodqty, userid, 
										orderyear, ordermonth, orderday, ordercode) 
                  VALUES(:orderid:, :orderdate:, :ordertime:, :expectedtime:, :afterminutes:, :status:, :restauname:, :foodid:, 
                         :foodname:, :foodprice:, :foodpricesmall:, :foodpricemedium:, :foodpricebig:, :foodqty:, :userid:, 
						 :orderyear:, :ordermonth:, :orderday:, :ordercode:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'orderid'				    =>	$orderFood->orderid,
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
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "food order created successfully",
                'data' => $orderFood,
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