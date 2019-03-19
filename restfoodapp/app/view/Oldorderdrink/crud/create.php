<?php
use Phalcon\Http\Response;
// -------------------------- POST AN OLD DRINK ORDER --------------------------
$app->post('/api/v1/oldorderdrinks', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $orderDrink = $app->request->getJsonRawBody();

    $phqlCheckOrderId = 'SELECT id FROM Oldorderdrink WHERE id = :id:';

    $orderDrinkCheckId = $app->modelsManager->executeQuery(
        $phqlCheckOrderId,
        [
            'id' => $orderDrink->id,
        ]
    )->getFirst();

    if((is_object($orderDrinkCheckId)) and ($orderDrinkCheckId->id === $orderDrink->id)){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "old drink order can not be created",
            'id' => "id must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Oldorderdrink (id, orderid, ordercode, drinkid, drinkname, drinkprice, drinkqty, orderdate, ordertime, 
                                         expectedtime, afterminutes, status, userid, orderyear, ordermonth, orderday, restauname) 
                  VALUES(:id:, :orderid:, :ordercode:, :drinkid:, :drinkname:, :drinkprice:, :drinkqty:, :orderdate:, :ordertime:, 
                         :expectedtime:, :afterminutes:, :status:, :userid:, :orderyear:, :ordermonth:, :orderday:, :restauname:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				        =>	$orderDrink->id,
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
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "old drink order created successfully",
                'data' => $orderDrink,
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