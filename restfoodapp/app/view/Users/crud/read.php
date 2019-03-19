<?php
use Phalcon\Http\Response;
// -------------------------- GET ALL USERS --------------------------
$app->get('/api/v1/users', function () use ($app) {
    // first
    $phql = "SELECT * FROM Users ORDER BY userid";

    $users = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($users) !== 0){
        foreach($users as $user) {
            $data[] = [
                'userid'				    =>	$user->userid,
                'fname'		                =>	$user->fname,
                'lname'			            =>	$user->lname,
                'email'	                    =>	$user->email,
                'phonenumber'	            =>	$user->phonenumber,
                'username'			        =>	$user->username,
                'password'		            =>	$user->password,
                'status'			        =>	$user->status,
                'registrationyear'	        =>	$user->registrationyear,
                'registrationmonth'	        =>	$user->registrationmonth,
                'registrationday'		    =>	$user->registrationday,
                'datebirth'		            =>	$user->datebirth,
                'nationality'		        =>	$user->nationality,
                'gender'		            =>	$user->gender,
                'description'		        =>	$user->description,
                'otherinfo'		            =>	$user->otherinfo,
                'homeaddress'		        =>	$user->homeaddress,
                'city'		                =>	$user->city,
                'country'		            =>	$user->country,
                'photo'		                =>	$user->photo,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'users exist',
            'data' => $data,
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
        $response->setJsonContent([
            'status' => 'error',
            'messages' => 'users don\'t exist',
            'data' => $data,
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
    }
    // third
    return $response;
});
// -------------------------- GET A USER --------------------------
$app->get('/api/v1/users/{userid}', function ($userid) use ($app) {
    // first
    $phql = "SELECT * FROM Users WHERE userid = :userid:";

    $user = $app->modelsManager->executeQuery(
        $phql,
        [
            'userid' => $userid
        ]
    )->getFirst();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if($user === false){
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "user with userid : ".$userid." doesn't exist",
            'data' => $data,
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
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "user with userid : ".$userid." exists",
            'data' => [
                'userid'				    =>	$user->userid,
                'fname'		                =>	$user->fname,
                'lname'			            =>	$user->lname,
                'email'	                    =>	$user->email,
                'phonenumber'	            =>	$user->phonenumber,
                'username'			        =>	$user->username,
                'password'		            =>	$user->password,
                'status'			        =>	$user->status,
                'registrationyear'	        =>	$user->registrationyear,
                'registrationmonth'	        =>	$user->registrationmonth,
                'registrationday'		    =>	$user->registrationday,
                'datebirth'		            =>	$user->datebirth,
                'nationality'		        =>	$user->nationality,
                'gender'		            =>	$user->gender,
                'description'		        =>	$user->description,
                'otherinfo'		            =>	$user->otherinfo,
                'homeaddress'		        =>	$user->homeaddress,
                'city'		                =>	$user->city,
                'country'		            =>	$user->country,
                'photo'		                =>	$user->photo,
            ],
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
    }
    // third
    return $response;
});