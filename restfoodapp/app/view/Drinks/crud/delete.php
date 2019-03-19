<?php
use Phalcon\Http\Response;
// -------------------------- DELETE A DRINK --------------------------
$app->delete('/api/v1/drinks/{drinkid}', function ($drinkid) use ($app) {
    // first
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
            'messages' => "drink with drinkid : ".$drinkid." can not be deleted because it doesn't exist",
        ]);
    }else{
        $phql = 'DELETE FROM Drinks WHERE drinkid = :drinkid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'drinkid'				    =>	$drinkid,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(202, 'Accepted');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "drink with drinkid : ".$drinkid." has been deleted successfully",
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