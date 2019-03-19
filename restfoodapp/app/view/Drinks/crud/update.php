<?php
use Phalcon\Http\Response;
// -------------------------- UPDATE A DRINK --------------------------
$app->put('/api/v1/drinks/{drinkid}', function ($drinkid) use ($app) {
    // first
    $drink = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $phqlCheck = "SELECT * FROM Drinks WHERE drinkid = :drinkid:";

    $drinkCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'drinkid' => $drinkid
        ]
    )->getFirst();

    if($drinkCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "drink with drinkid : ".$drinkid." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Drinks SET restoid = :restoid:, restauname = :restauname:, drinkname = :drinkname:, type = :type:, price = :price:, 
                               available = :available:, dateinserted = :dateinserted:, lastupdateddate = :lastupdateddate:, discount = :discount:, 
                               description = :description:, size = :size:, photo = :photo: 
             WHERE drinkid = :drinkid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'drinkid'				    =>	$drinkid,
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