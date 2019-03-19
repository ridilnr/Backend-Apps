<?php
use Phalcon\Http\Response;
// -------------------------- POST A COUNTRY --------------------------
$app->post('/api/v1/countries', function () use ($app) {
    // first
    $country = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $phqlCheckCid = 'SELECT cid FROM Countries WHERE cid = :cid:';

    $countryCheckCid = $app->modelsManager->executeQuery(
        $phqlCheckCid,
        [
            'cid' => $country->cid,
        ]
    )->getFirst();

    if((is_object($countryCheckCid)) and ($countryCheckCid->cid === $country->cid)) {
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "country can not be created",
            'cid' => "cid must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Countries (cid, countryname, status) VALUES (:cid:, :countryname:, :status:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'cid'				        =>	$country->cid,
                'countryname'		        =>	$country->countryname,
                'status'			        =>	$country->status
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');

            $country->cid = $status->getModel()->cid;

            $response->setJsonContent([
                'status' => 'success',
                'messages' => "country created successfully",
                'data' => $country,
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
    return $response;
});