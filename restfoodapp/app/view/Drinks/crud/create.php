<?php
use Phalcon\Http\Response;
// -------------------------- POST A DRINK --------------------------
$app->post('/api/v1/drinks', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $drink = $app->request->getJsonRawBody();

    $phqlCheckDrinkId = 'SELECT drinkid FROM Drinks WHERE drinkid = :drinkid:';

    $drinkCheckId = $app->modelsManager->executeQuery(
        $phqlCheckDrinkId,
        [
            'drinkid' => $drink->drinkid,
        ]
    )->getFirst();

    if((is_object($drinkCheckId)) and ($drinkCheckId->drinkid === $drink->drinkid)) {
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "drink can not be created",
            'drinkid' => "drinkid must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Drinks (drinkid, restoid, restauname, drinkname, type, price,  available, dateinserted, lastupdateddate, discount, description, size, photo)
                 VALUES (:drinkid:, :restoid:, :restauname:, :drinkname:, :type:, :price:, :available:, :dateinserted:, :lastupdateddate:, :discount:, :description:, :size:, :photo:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'drinkid'				    =>	$drink->drinkid,
                'restoid'		            =>	$drink->restoid,
                'restauname'			    =>	$drink->restauname,
                'drinkname'	                =>	$drink->drinkname,
                'type'			            =>	$drink->type,
                'price'			            =>	$drink->price,
                'available'	                =>	$drink->available,
                'dateinserted'	            =>	$drink->dateinserted,
                'lastupdateddate'		    =>	$drink->lastupdateddate,
                'discount'		            =>	$drink->discount,
                'description'		        =>	$drink->description,
                'size'		                =>	$drink->size,
                'photo'	                    =>	$drink->photo
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "drink created successfully",
                'data' => $drink,
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