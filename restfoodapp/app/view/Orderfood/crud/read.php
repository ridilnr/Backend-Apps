<?php
use Phalcon\Http\Response;
// -------------------------- GET ALL FOOD ORDERS --------------------------
$app->get('/api/v1/orderfoods', function () use ($app) {
    // first
    $phql = "SELECT * FROM Orderfood ORDER BY orderid";

    $oldorderfoods = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if(sizeof($oldorderfoods) !== 0){
        foreach($oldorderfoods as $oof) {
            $data[] = [
                'orderid'				    =>	$oof->orderid,
                'orderdate'		            =>	$oof->orderdate,
                'ordertime'			        =>	$oof->ordertime,
                'expectedtime'	            =>	$oof->expectedtime,
                'afterminutes'	            =>	$oof->afterminutes,
                'status'			        =>	$oof->status,
                'restauname'		        =>	$oof->restauname,
                'foodid'		            =>	$oof->foodid,
                'foodname'		            =>	$oof->foodname,
                'foodprice'		            =>	$oof->foodprice,
                'foodpricesmall'		    =>	$oof->foodpricesmall,
                'foodpricemedium'		    =>	$oof->foodpricemedium,
                'foodpricebig'		    	=>	$oof->foodpricebig,
                'foodqty'		            =>	$oof->foodqty,
                'userid'		            =>	$oof->userid,
                'orderyear'		            =>	$oof->orderyear,
                'ordermonth'		        =>	$oof->ordermonth,
                'orderday'		            =>	$oof->orderday,
                'ordercode'		            =>	$oof->ordercode,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'food orders exist',
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
            'messages' => 'food orders don\'t exist',
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
// -------------------------- GET ALL FOOD ORDERS OF A USER --------------------------
$app->get('/api/v1/user/orderfoods/{userid}', function ($userid) use ($app) {
    // first
    $phql = "SELECT * FROM Orderfood WHERE userid = :userid: ORDER BY orderid";

    $oldorderfoods = $app->modelsManager->executeQuery(
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

    if(sizeof($oldorderfoods) !== 0){
        foreach($oldorderfoods as $oof) {
            $data[] = [
                'orderid'				    =>	$oof->orderid,
                'orderdate'		            =>	$oof->orderdate,
                'ordertime'			        =>	$oof->ordertime,
                'expectedtime'	            =>	$oof->expectedtime,
                'afterminutes'	            =>	$oof->afterminutes,
                'status'			        =>	$oof->status,
                'restauname'		        =>	$oof->restauname,
                'foodid'		            =>	$oof->foodid,
                'foodname'		            =>	$oof->foodname,
                'foodprice'		            =>	$oof->foodprice,
                'foodpricesmall'		    =>	$oof->foodpricesmall,
                'foodpricemedium'		    =>	$oof->foodpricemedium,
                'foodpricebig'		    	=>	$oof->foodpricebig,
                'foodqty'		            =>	$oof->foodqty,
                'userid'		            =>	$oof->userid,
                'orderyear'		            =>	$oof->orderyear,
                'ordermonth'		        =>	$oof->ordermonth,
                'orderday'		            =>	$oof->orderday,
                'ordercode'		            =>	$oof->ordercode,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "food orders of user with userid = $userid exist",
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
            'messages' => "food orders of user with userid = $userid don't exist",
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

// -------------------------- GET A FOOD ORDER --------------------------
$app->get('/api/v1/orderfoods/{orderid}', function ($orderid) use ($app) {
    // first
    $phqlA = "SELECT * FROM Orderfood WHERE orderid = :orderid:";

    $phqlB = "SELECT * FROM Orderfood WHERE ordercode = :ordercode:";

    $phqlC = "SELECT * FROM Orderfood WHERE userid = :userid:";

    $orderFoodOne = $app->modelsManager->executeQuery(
        $phqlA,
        [
            'orderid' => $orderid,
        ]
    )->getFirst();

    $orderFoodTwo = $app->modelsManager->executeQuery(
        $phqlB,
        [
            'ordercode' => $orderid,
        ]
    );

    $orderFoodThree = $app->modelsManager->executeQuery(
        $phqlC,
        [
            'userid' => $orderid,
        ]
    );

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if($orderFoodOne === false){
        if(sizeof($orderFoodTwo) === 0){
            if(sizeof($orderFoodThree) === 0) {
                $response->setStatusCode(406, 'Not Acceptable');
                $response->setJsonContent([
                    'status' => 'error',
                    'messages' => "food order with parameter : " . $orderid . " doesn't exist",
                    'data' => array(),
                ]);
            }else {
                foreach ($orderFoodThree as $oft) {
                    $data[] = [
                        'orderid'				    =>	$oft->orderid,
                        'orderdate'		            =>	$oft->orderdate,
                        'ordertime'			        =>	$oft->ordertime,
                        'expectedtime'	            =>	$oft->expectedtime,
                        'afterminutes'	            =>	$oft->afterminutes,
                        'status'			        =>	$oft->status,
                        'restauname'		        =>	$oft->restauname,
                        'foodid'		            =>	$oft->foodid,
                        'foodname'		            =>	$oft->foodname,
                        'foodprice'		            =>	$oft->foodprice,
						'foodpricesmall'		    =>	$oft->foodpricesmall,
						'foodpricemedium'		    =>	$oft->foodpricemedium,
						'foodpricebig'		    	=>	$oft->foodpricebig,
                        'foodqty'		            =>	$oft->foodqty,
                        'userid'		            =>	$oft->userid,
                        'orderyear'		            =>	$oft->orderyear,
                        'ordermonth'		        =>	$oft->ordermonth,
                        'orderday'		            =>	$oft->orderday,
                        'ordercode'		            =>	$oft->ordercode,
                    ];
                }
                $response->setJsonContent([
                    'status' => 'success',
                    'messages' => "food order with parameter : ".$orderid." exists",
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
            foreach ($orderFoodTwo as $oft) {
                $data[] = [
                    'orderid'				    =>	$oft->orderid,
                    'orderdate'		            =>	$oft->orderdate,
                    'ordertime'			        =>	$oft->ordertime,
                    'expectedtime'	            =>	$oft->expectedtime,
                    'afterminutes'	            =>	$oft->afterminutes,
                    'status'			        =>	$oft->status,
                    'restauname'		        =>	$oft->restauname,
                    'foodid'		            =>	$oft->foodid,
                    'foodname'		            =>	$oft->foodname,
                    'foodprice'		            =>	$oft->foodprice,
					'foodpricesmall'		    =>	$oft->foodpricesmall,
					'foodpricemedium'		    =>	$oft->foodpricemedium,
					'foodpricebig'		    	=>	$oft->foodpricebig,
                    'foodqty'		            =>	$oft->foodqty,
                    'userid'		            =>	$oft->userid,
                    'orderyear'		            =>	$oft->orderyear,
                    'ordermonth'		        =>	$oft->ordermonth,
                    'orderday'		            =>	$oft->orderday,
                    'ordercode'		            =>	$oft->ordercode,
                ];
            }
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "food order with parameter : ".$orderid." exists",
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
            'messages' => "food order with parameter : ".$orderid." exists",
            'data' => [
                'orderid'				    =>	$orderFoodOne->orderid,
                'orderdate'		            =>	$orderFoodOne->orderdate,
                'ordertime'			        =>	$orderFoodOne->ordertime,
                'expectedtime'	            =>	$orderFoodOne->expectedtime,
                'afterminutes'	            =>	$orderFoodOne->afterminutes,
                'status'			        =>	$orderFoodOne->status,
                'restauname'		        =>	$orderFoodOne->restauname,
                'foodid'		            =>	$orderFoodOne->foodid,
                'foodname'		            =>	$orderFoodOne->foodname,
                'foodprice'		            =>	$orderFoodOne->foodprice,
                'foodpricesmall'		    =>	$orderFoodOne->foodpricesmall,
                'foodpricemedium'		    =>	$orderFoodOne->foodpricemedium,
                'foodpricebig'		    	=>	$orderFoodOne->foodpricebig,
                'foodqty'		            =>	$orderFoodOne->foodqty,
                'userid'		            =>	$orderFoodOne->userid,
                'orderyear'		            =>	$orderFoodOne->orderyear,
                'ordermonth'		        =>	$orderFoodOne->ordermonth,
                'orderday'		            =>	$orderFoodOne->orderday,
                'ordercode'		            =>	$orderFoodOne->ordercode,
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