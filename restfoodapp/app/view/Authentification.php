<?php
use Phalcon\Http\Response;
/*
***************************** AUTHENTICATION USER *****************************
 */
$app->post('/api/v1/users/authentication', function () use ($app) {
    // first
    $checkUser = $app->request->getJsonRawBody();

    // first
    $phql = "SELECT * FROM Users WHERE email = :email:";

    $user = $app->modelsManager->executeQuery(
        $phql,
        [
            'email' => $checkUser->email,
        ]
    )->getFirst();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if($user === false){
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "User doesn't exist",
            'data' => array(),
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
        $this->security->hash(rand());
    }else{
        if ($this->security->checkHash($checkUser->password, $user->password)) {
            $response->setJsonContent([
                'status' => 'success',
                'messages' => 'User exists',
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
                    'country'		            =>	$user->country
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
        }else{
            $response->setJsonContent([
                'status' => 'error',
                'messages' => 'Email or password is incorrect',
                'data' => [],
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
    }
    // third
    return $response;
});