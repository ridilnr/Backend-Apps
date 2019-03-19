<?php
use Phalcon\Http\Response;
// -------------------------- POST A CITY --------------------------
$app->post('/api/v1/cities', function () use ($app) {
    // first
    $city = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheckCityId = 'SELECT cityid FROM Cities WHERE cityid = :cityid:';

    $cityCheckCityId = $app->modelsManager->executeQuery(
        $phqlCheckCityId,
        [
            'cityid' => $city->cityid,
        ]
    )->getFirst();

    if((is_object($cityCheckCityId)) and ($cityCheckCityId->cityid === $city->cityid)) {
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "city can not be created",
            'cityid' => "cityid must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Cities (cityid, cityname, countryname, description, otherinfo, status) 
                 VALUES (:cityid:, :cityname:, :countryname:, :description:, :otherinfo:, :status:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'cityid'				    =>	$city->cityid,
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
            $response->setStatusCode(201, 'Created');

            $city->cityid = $status->getModel()->cityid;

            $response->setJsonContent([
                'status' => 'success',
                'messages' => "city created successfully",
                'data' => $city,
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
                ]
            );
        }
    }
    // third
    return $response;
});