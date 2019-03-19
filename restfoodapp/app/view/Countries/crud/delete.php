<?php
use Phalcon\Http\Response;
// -------------------------- DELETE A COUNTRY --------------------------
$app->delete('/api/v1/countries/{cid}', function ($cid) use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Countries WHERE cid = :cid:";

    $countryCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'cid' => $cid
        ]
    )->getFirst();

    if($countryCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "country with cid : ".$cid." can not be deleted because it doesn't exist",
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
        $phql = 'DELETE FROM Countries WHERE cid = :cid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'cid'				        =>	$cid,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(202, 'Accepted');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "country with cid : ".$cid." has been deleted successfully",
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
    return $response;
});