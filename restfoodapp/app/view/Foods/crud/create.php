<?php
use Phalcon\Http\Response;
// -------------------------- POST A FOOD --------------------------
$app->post('/api/v1/foods', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $food = $app->request->getJsonRawBody();

    $phqlCheckfoodid = 'SELECT foodid FROM Foods WHERE foodid = :foodid:';

    $foodCheckId = $app->modelsManager->executeQuery(
        $phqlCheckfoodid,
        [
            'foodid' => $food->foodid,
        ]
    )->getFirst();

    if((is_object($foodCheckId)) and ($foodCheckId->foodid === $food->foodid)){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "food can not be created",
            'foodid' => "foodid must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Foods (foodid, restoid, restauname, foodname, photo, price, pricesmall, pricemedium, pricebig, description, type,  available, dateinserted, lastupdateddate, discount, size)
                 VALUES (:foodid:, :restoid:, :restauname:, :foodname:, :photo:, :price:, :pricesmall:, :pricemedium:, :pricebig:, :description:, :type:, :available:, :dateinserted:, :lastupdateddate:, :discount:, :size:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'foodid'				    =>	$food->foodid,
                'restoid'		            =>	$food->restoid,
                'restauname'			    =>	$food->restauname,
                'foodname'	                =>	$food->foodname,
                'photo'	                    =>	$food->photo,
                'price'			            =>	$food->price,
                'pricesmall'			    =>	$food->pricesmall,
                'pricemedium'			    =>	$food->pricemedium,
                'pricebig'			        =>	$food->pricebig,
                'description'		        =>	$food->description,
                'type'			            =>	$food->type,
                'available'	                =>	$food->available,
                'dateinserted'	            =>	$food->dateinserted,
                'lastupdateddate'		    =>	$food->lastupdateddate,
                'discount'		            =>	$food->discount,
                'size'		                =>	$food->size
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "food created successfully",
                'data' => $food,
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