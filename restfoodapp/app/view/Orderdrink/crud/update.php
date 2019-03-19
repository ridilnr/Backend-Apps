<?php
use Phalcon\Http\Response;
// -------------------------- UPDATE A DRINK ORDER --------------------------
$app->put('/api/v1/orderdrinks/{id}', function ($id) use ($app) {
    // first
    $orderDrink = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Orderdrink WHERE id = :id:";

    $orderCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'id' => $id
        ]
    )->getFirst();

    if($orderCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "drink order with id : ".$id." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Orderdrink SET orderid = :orderid:, ordercode = :ordercode:, drinkid = :drinkid:, drinkname = :drinkname:, 
                                       drinkprice = :drinkprice:, drinkqty = :drinkqty:, orderdate = :orderdate:, ordertime = :ordertime:, 
                                       expectedtime = :expectedtime:, afterminutes = :afterminutes:, status = :status:, userid = :userid:, 
                                       orderyear = :orderyear:, ordermonth = :ordermonth:, orderday = :orderday:, restauname = :restauname: 
                  WHERE id = :id:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				        =>	$id,
                'orderid'				    =>	$orderDrink->orderid,
                'ordercode'		            =>	$orderDrink->ordercode,
                'drinkid'		            =>	$orderDrink->drinkid,
                'drinkname'		            =>	$orderDrink->drinkname,
                'drinkprice'		        =>	$orderDrink->drinkprice,
                'drinkqty'		            =>	$orderDrink->drinkqty,
                'orderdate'		            =>	$orderDrink->orderdate,
                'ordertime'			        =>	$orderDrink->ordertime,
                'expectedtime'	            =>	$orderDrink->expectedtime,
                'afterminutes'	            =>	$orderDrink->afterminutes,
                'status'			        =>	$orderDrink->status,
                'userid'		            =>	$orderDrink->userid,
                'orderyear'		            =>	$orderDrink->orderyear,
                'ordermonth'		        =>	$orderDrink->ordermonth,
                'orderday'		            =>	$orderDrink->orderday,
                'restauname'		        =>	$orderDrink->restauname,
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