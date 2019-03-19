<?php
use Phalcon\Http\Response;
// -------------------------- GET ALL OLD DRINK ORDERS --------------------------
$app->get('/api/v1/oldorderdrinks', function () use ($app) {
    // first
    $phql = "SELECT * FROM Oldorderdrink ORDER BY id";

    $oldorderdrinks = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if(sizeof($oldorderdrinks) !== 0){
        foreach($oldorderdrinks as $ood) {
            $data[] = [
                'id'				        =>	$ood->id,
                'orderid'				    =>	$ood->orderid,
                'ordercode'		            =>	$ood->ordercode,
                'drinkid'		            =>	$ood->drinkid,
                'drinkname'		            =>	$ood->drinkname,
                'drinkprice'		        =>	$ood->drinkprice,
                'drinkqty'		            =>	$ood->drinkqty,
                'orderdate'		            =>	$ood->orderdate,
                'ordertime'			        =>	$ood->ordertime,
                'expectedtime'	            =>	$ood->expectedtime,
                'afterminutes'	            =>	$ood->afterminutes,
                'status'			        =>	$ood->status,
                'userid'		            =>	$ood->userid,
                'orderyear'		            =>	$ood->orderyear,
                'ordermonth'		        =>	$ood->ordermonth,
                'orderday'		            =>	$ood->orderday,
                'restauname'		        =>	$ood->restauname,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'old drink orders exist',
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
            'messages' => 'old drink orders don\'t exist',
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
// -------------------------- GET ALL OLD DRINK ORDERS OF A USER --------------------------
$app->get('/api/v1/user/oldorderdrinks/{userid}', function ($userid) use ($app) {
    // first
    $phql = "SELECT * FROM Oldorderdrink WHERE userid = :userid: ORDER BY id";

    $oldorderdrinks = $app->modelsManager->executeQuery(
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

    if(sizeof($oldorderdrinks) !== 0){
        foreach($oldorderdrinks as $ood) {
            $data[] = [
                'id'				        =>	$ood->id,
                'orderid'				    =>	$ood->orderid,
                'ordercode'		            =>	$ood->ordercode,
                'drinkid'		            =>	$ood->drinkid,
                'drinkname'		            =>	$ood->drinkname,
                'drinkprice'		        =>	$ood->drinkprice,
                'drinkqty'		            =>	$ood->drinkqty,
                'orderdate'		            =>	$ood->orderdate,
                'ordertime'			        =>	$ood->ordertime,
                'expectedtime'	            =>	$ood->expectedtime,
                'afterminutes'	            =>	$ood->afterminutes,
                'status'			        =>	$ood->status,
                'userid'		            =>	$ood->userid,
                'orderyear'		            =>	$ood->orderyear,
                'ordermonth'		        =>	$ood->ordermonth,
                'orderday'		            =>	$ood->orderday,
                'restauname'		        =>	$ood->restauname,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'old drink orders exist',
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
            'messages' => 'old drink orders don\'t exist',
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
// -------------------------- GET AN OLD DRINK ORDER --------------------------
$app->get('/api/v1/oldorderdrinks/{id}', function ($id) use ($app) {
    // first
    $phqlA = "SELECT * FROM Oldorderdrink WHERE id = :id:";

    $phqlB = "SELECT * FROM Oldorderdrink WHERE orderid = :orderid:";

    $phqlC = "SELECT * FROM Oldorderdrink WHERE ordercode = :ordercode:";

    $phqlD = "SELECT * FROM Oldorderdrink WHERE userid = :userid:";

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

    $orderDrinkFour = $app->modelsManager->executeQuery(
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
                if(sizeof($orderDrinkFour) === 0){
                    $response->setStatusCode(406, 'Not Acceptable');
                    $response->setJsonContent([
                        'status' => 'error',
                        'messages' => "old drink order with parameter : ".$id." doesn't exist",
                        'data' => array(),
                    ]);
                }else {
                    foreach ($orderDrinkFour as $odf) {
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
                        'messages' => "old drink order with parameter : ".$id." exists",
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
                    'messages' => "old drink order with parameter : ".$id." exists",
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
                'messages' => "old drink order with parameter : ".$id." exists",
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
            'messages' => "old drink order with parameter : ".$id." exists",
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