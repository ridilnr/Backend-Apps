<?php
use Phalcon\Http\Response;
// -------------------------- DELETE A FOOD ORDER --------------------------
$app->delete('/api/v1/orderfoods/{orderid}', function ($orderid) use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    //
    $phqlCheck = "SELECT * FROM Orderfood WHERE orderid = :orderid:";

    $orderDrinkCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'orderid' => $orderid
        ]
    )->getFirst();

    if($orderDrinkCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "food order with orderid : ".$orderid." can not be deleted because it doesn't exist",
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
        $phql = 'DELETE FROM Orderfood WHERE orderid = :orderid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'orderid'				    =>	$orderid,
            ]
        );

        // Check if the deletion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(202, 'Accepted');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "food order with orderid : ".$orderid." has been deleted successfully",
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