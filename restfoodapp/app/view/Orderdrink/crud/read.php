<?php
use Phalcon\Http\Response;
// -------------------------- GET ALL DRINK ORDERS --------------------------
$app->get('/api/v1/orderdrinks', function () use ($app) {
    // first
    $phql = "SELECT * FROM Orderdrink ORDER BY id";

    $orderdrinks = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if(sizeof($orderdrinks) !== 0){
        foreach($orderdrinks as $od) {
            $data[] = [
                'id'				        =>	$od->id,
                'orderid'				    =>	$od->orderid,
                'ordercode'		            =>	$od->ordercode,
                'drinkid'		            =>	$od->drinkid,
                'drinkname'		            =>	$od->drinkname,
                'drinkprice'		        =>	$od->drinkprice,
                'drinkqty'		            =>	$od->drinkqty,
                'orderdate'		            =>	$od->orderdate,
                'ordertime'			        =>	$od->ordertime,
                'expectedtime'	            =>	$od->expectedtime,
                'afterminutes'	            =>	$od->afterminutes,
                'status'			        =>	$od->status,
                'userid'		            =>	$od->userid,
                'orderyear'		            =>	$od->orderyear,
                'ordermonth'		        =>	$od->ordermonth,
                'orderday'		            =>	$od->orderday,
                'restauname'		        =>	$od->restauname,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'drink orders exist',
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
            'messages' => 'drink orders don\'t exist',
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
// -------------------------- GET ALL DRINK ORDERS OF A USER --------------------------
$app->get('/api/v1/user/orderdrinks/{userid}', function ($userid) use ($app) {
    // first
    $phql = "SELECT * FROM Orderdrink WHERE userid = :userid: ORDER BY id";

    $orderdrinks = $app->modelsManager->executeQuery(
        $phql,
        [
            'userid' => $userid,
        ]
    );

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if(sizeof($orderdrinks) !== 0){
        foreach($orderdrinks as $od) {
            $data[] = [
                'id'				        =>	$od->id,
                'orderid'				    =>	$od->orderid,
                'ordercode'		            =>	$od->ordercode,
                'drinkid'		            =>	$od->drinkid,
                'drinkname'		            =>	$od->drinkname,
                'drinkprice'		        =>	$od->drinkprice,
                'drinkqty'		            =>	$od->drinkqty,
                'orderdate'		            =>	$od->orderdate,
                'ordertime'			        =>	$od->ordertime,
                'expectedtime'	            =>	$od->expectedtime,
                'afterminutes'	            =>	$od->afterminutes,
                'status'			        =>	$od->status,
                'userid'		            =>	$od->userid,
                'orderyear'		            =>	$od->orderyear,
                'ordermonth'		        =>	$od->ordermonth,
                'orderday'		            =>	$od->orderday,
                'restauname'		        =>	$od->restauname,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "drink orders of user with userid = $userid exist",
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
            'messages' => "drink orders of user with userid = $userid don't exist",
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
// -------------------------- GET A DRINK ORDER --------------------------
$app->get('/api/v1/orderdrinks/{id}', function ($id) use ($app) {
    // first
    $phqlA = "SELECT * FROM Orderdrink WHERE id = :id:";

    $phqlB = "SELECT * FROM Orderdrink WHERE orderid = :orderid:";

    $phqlC = "SELECT * FROM Orderdrink WHERE ordercode = :ordercode:";

    $phqlD = "SELECT * FROM Orderdrink WHERE userid = :userid:";

    $orderDrinkOne = $app->modelsManager->executeQuery(
        $phqlA,
        [
            'id' => $id,
        ]
    )->getFirst();

    $orderDrinkTwo = $app->modelsManager->executeQuery(
        $phqlB,
        [
            'orderid' => $id,
        ]
    );

    $orderDrinkThree = $app->modelsManager->executeQuery(
        $phqlC,
        [
            'ordercode' => $id,
        ]
    );

    $orderFoodFour = $app->modelsManager->executeQuery(
        $phqlD,
        [
            'userid' => $id,
        ]
    );

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if($orderDrinkOne === false){
        if(sizeof($orderDrinkTwo) === 0){
            if(sizeof($orderDrinkThree) === 0){
                if(sizeof($orderFoodFour) === 0){
                    $response->setStatusCode(406, 'Not Acceptable');
                    $response->setJsonContent([
                        'status' => 'error',
                        'messages' => "drink order with parameter : ".$id." doesn't exist",
                        'data' => array(),
                    ]);
                }else {
                    foreach ($orderFoodFour as $odf) {
                        $data[] = [
                            'id'				        =>	$odf->id,
                            'orderid'				    =>	$odf->orderid,
                            'ordercode'		            =>	$odf->ordercode,
                            'drinkid'		            =>	$odf->drinkid,
                            'drinkname'		            =>	$odf->drinkname,
                            'drinkprice'		        =>	$odf->drinkprice,
                            'drinkqty'		            =>	$odf->drinkqty,
                            'orderdate'		            =>	$odf->orderdate,
                            'ordertime'			        =>	$odf->ordertime,
                            'expectedtime'	            =>	$odf->expectedtime,
                            'afterminutes'	            =>	$odf->afterminutes,
                            'status'			        =>	$odf->status,
                            'userid'		            =>	$odf->userid,
                            'orderyear'		            =>	$odf->orderyear,
                            'ordermonth'		        =>	$odf->ordermonth,
                            'orderday'		            =>	$odf->orderday,
                            'restauname'		        =>	$odf->restauname,
                        ];
                    }
                    $response->setJsonContent([
                        'status' => 'success',
                        'messages' => "drink order with parameter : ".$id." exists",
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
            }else{
                foreach ($orderDrinkThree as $odt) {
                    $data[] = [
                        'id'				        =>	$odt->id,
                        'orderid'				    =>	$odt->orderid,
                        'ordercode'		            =>	$odt->ordercode,
                        'drinkid'		            =>	$odt->drinkid,
                        'drinkname'		            =>	$odt->drinkname,
                        'drinkprice'		        =>	$odt->drinkprice,
                        'drinkqty'		            =>	$odt->drinkqty,
                        'orderdate'		            =>	$odt->orderdate,
                        'ordertime'			        =>	$odt->ordertime,
                        'expectedtime'	            =>	$odt->expectedtime,
                        'afterminutes'	            =>	$odt->afterminutes,
                        'status'			        =>	$odt->status,
                        'userid'		            =>	$odt->userid,
                        'orderyear'		            =>	$odt->orderyear,
                        'ordermonth'		        =>	$odt->ordermonth,
                        'orderday'		            =>	$odt->orderday,
                        'restauname'		        =>	$odt->restauname,
                    ];
                }
                $response->setJsonContent([
                    'status' => 'success',
                    'messages' => "drink order with parameter : ".$id." exists",
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
        }else{
            foreach ($orderDrinkTwo as $odt) {
                $data[] = [
                    'id'				        =>	$odt->id,
                    'orderid'				    =>	$odt->orderid,
                    'ordercode'		            =>	$odt->ordercode,
                    'drinkid'		            =>	$odt->drinkid,
                    'drinkname'		            =>	$odt->drinkname,
                    'drinkprice'		        =>	$odt->drinkprice,
                    'drinkqty'		            =>	$odt->drinkqty,
                    'orderdate'		            =>	$odt->orderdate,
                    'ordertime'			        =>	$odt->ordertime,
                    'expectedtime'	            =>	$odt->expectedtime,
                    'afterminutes'	            =>	$odt->afterminutes,
                    'status'			        =>	$odt->status,
                    'userid'		            =>	$odt->userid,
                    'orderyear'		            =>	$odt->orderyear,
                    'ordermonth'		        =>	$odt->ordermonth,
                    'orderday'		            =>	$odt->orderday,
                    'restauname'		        =>	$odt->restauname,
                ];
            }
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "drink order with parameter : ".$id." exists",
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
    }else{
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "drink order with parameter : ".$id." exists",
            'data' => [
                'id'				        =>	$orderDrinkOne->id,
                'orderid'				    =>	$orderDrinkOne->orderid,
                'ordercode'		            =>	$orderDrinkOne->ordercode,
                'drinkid'		            =>	$orderDrinkOne->drinkid,
                'drinkname'		            =>	$orderDrinkOne->drinkname,
                'drinkprice'		        =>	$orderDrinkOne->drinkprice,
                'drinkqty'		            =>	$orderDrinkOne->drinkqty,
                'orderdate'		            =>	$orderDrinkOne->orderdate,
                'ordertime'			        =>	$orderDrinkOne->ordertime,
                'expectedtime'	            =>	$orderDrinkOne->expectedtime,
                'afterminutes'	            =>	$orderDrinkOne->afterminutes,
                'status'			        =>	$orderDrinkOne->status,
                'userid'		            =>	$orderDrinkOne->userid,
                'orderyear'		            =>	$orderDrinkOne->orderyear,
                'ordermonth'		        =>	$orderDrinkOne->ordermonth,
                'orderday'		            =>	$orderDrinkOne->orderday,
                'restauname'		        =>	$orderDrinkOne->restauname,
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