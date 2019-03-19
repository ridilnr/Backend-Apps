<?php
use Phalcon\Http\Response;
// -------------------------- UPDATE A FOOD --------------------------
$app->put('/api/v1/foods/{foodid}', function ($foodid) use ($app) {
    // first
    $food = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Foods WHERE foodid = :foodid:";

    $foodCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'foodid' => $foodid
        ]
    )->getFirst();

    if($foodCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "food with foodid : ".$foodid." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Foods SET restoid = :restoid:, restauname = :restauname:, foodname = :foodname:, photo = :photo:, 
                                  price = :price:, pricesmall = :pricesmall:, pricemedium = :pricemedium:, pricebig = :pricebig:, 
								  description = :description:, type = :type:, available = :available:, dateinserted = :dateinserted:, 
								  lastupdateddate = :lastupdateddate:, discount = :discount:, size = :size: 
                 WHERE foodid = :foodid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'foodid'				    =>	$foodid,
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