<?php
use Phalcon\Http\Response;
// -------------------------- UPDATE A CITY --------------------------
$app->put('/api/v1/cities/{cityid}', function ($cityid) use ($app) {
    // first
    $city = $app->request->getJsonRawBody();

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
            'messages' => "city with cityid : ".$cityid." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Cities SET cityname = :cityname:, countryname = :countryname:, description = :description:, 
                                   otherinfo = :otherinfo:, status = :status: 
                 WHERE cityid = :cityid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'cityid'				    =>	$cityid,
                'cityname'		            =>	$city->cityname,
                'countryname'			    =>	$city->countryname,
                'description'	            =>	$city->description,
                'otherinfo'	                =>	$city->otherinfo,
                'status'			        =>	$city->status
            ]
        );

        // Check if the insertion was successful
        if($status->success() === true){
            // Change the HTTP status
            $response->setStatusCode(204, 'No Content');
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