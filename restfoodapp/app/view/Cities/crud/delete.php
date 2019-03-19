<?php
use Phalcon\Http\Response;
// -------------------------- DELETE A CITY --------------------------
$app->delete('/api/v1/cities/{cityid}', function ($cityid) use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Cities WHERE cityid = :cityid:";

    $cityCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'cityid' => $cityid
        ]
    )->getFirst();

    if($cityCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "city with cityid : ".$cityid." can not be deleted because it doesn't exist",
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
        $phql = 'DELETE FROM Cities WHERE cityid = :cityid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'cityid'				    =>	$cityid,
            ]
        );

        // Check if the insertion was successful
        if($status->success() === true){
            // Change the HTTP status
            $response->setStatusCode(202, 'Accepted');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "city with cityid : ".$cityid." has been deleted successfully",
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