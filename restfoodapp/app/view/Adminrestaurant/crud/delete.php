<?php
use Phalcon\Http\Response;
// -------------------------- DELETE A RESTAURANT ADMINISTRATOR --------------------------
$app->delete('/api/v1/adminrestaurants/{idresto}', function ($idresto) use ($app) {
    // first

    // Create a response
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = 'SELECT * FROM Adminrestaurant WHERE idresto = :idresto:';

    $adminrestaurantCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'idresto' => $idresto,
        ]
    )->getFirst();

    if($adminrestaurantCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "restaurant administrator with idresto : ".$idresto." can not be deleted because it doesn't exist",
        ]);
    }else{
        $phql = 'DELETE FROM Adminrestaurant WHERE idresto = :idresto:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'idresto'				    =>	$idresto,
            ]
        );

        // Check if the insertion was successful
        if($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(202, 'Accepted');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "restaurant administrator with idresto : ".$idresto." has been deleted successfully",
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