<?php
use Phalcon\Http\Response;
// -------------------------- POST A USER --------------------------
$app->post('/api/v1/users', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $user = $app->request->getJsonRawBody();

    $userid = "u".str_replace(["-", ":", " "], "", date("Y-m-d H:i:s"))."".mt_rand(10000, 99999);

    $phqlCheckUserId = 'SELECT userid FROM Users WHERE userid = :userid:';

    $userCheckId = $app->modelsManager->executeQuery(
        $phqlCheckUserId,
        [
            'userid' => $userid,
        ]
    )->getFirst();

    if((is_object($userCheckId)) and ($userCheckId->userid === $userid)){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "user can not be created",
            'userid' => "userid must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Users (userid, fname, lname, email, phonenumber, username, password, registrationyear, registrationmonth, 
                                    registrationday, nationality, description, otherinfo, city, country, photo) 
                  VALUES (:userid:, :fname:, :lname:, :email:,  :phonenumber:, :username:, :password:, :registrationyear:, :registrationmonth:, 
                          :registrationday:, :nationality:, :description:, :otherinfo:, :city:, :country:, :photo:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'userid'				    =>	$userid,
                'fname'		                =>	$user->fname,
                'lname'			            =>	$user->lname,
                'email'	                    =>	$user->email,
                'phonenumber'	            =>	$user->phonenumber,
                'username'			        =>	$user->username,
                'password'		            =>	$this->security->hash($user->password),
                'registrationyear'	        =>	date("Y"),
                'registrationmonth'	        =>	date("m"),
                'registrationday'		    =>	date("d"),
                'nationality'		        =>	$user->nationality,
                'description'		        =>	$user->description,
                'otherinfo'		            =>	$user->otherinfo,
                'city'		                =>	$user->city,
                'country'		            =>	$user->country,
                'photo'		                =>	$user->photo,
            ]
        );
        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $phql = "SELECT * FROM Users WHERE userid = :userid:";

            $userCreated = $app->modelsManager->executeQuery(
                $phql,
                [
                    'userid' => $userid
                ]
            )->getFirst();
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "user created successfully",
                'data' => [
                    'userid'				    =>	$userCreated->userid,
                    'fname'		                =>	$userCreated->fname,
                    'lname'			            =>	$userCreated->lname,
                    'email'	                    =>	$userCreated->email,
                    'phonenumber'	            =>	$userCreated->phonenumber,
                    'username'			        =>	$userCreated->username,
                    'password'		            =>	$userCreated->password,
                    'status'			        =>	$userCreated->status,
                    'registrationyear'	        =>	$userCreated->registrationyear,
                    'registrationmonth'	        =>	$userCreated->registrationmonth,
                    'registrationday'		    =>	$userCreated->registrationday,
                    'datebirth'		            =>	$userCreated->datebirth,
                    'nationality'		        =>	$userCreated->nationality,
                    'gender'		            =>	$userCreated->gender,
                    'description'		        =>	$userCreated->description,
                    'otherinfo'		            =>	$userCreated->otherinfo,
                    'homeaddress'		        =>	$userCreated->homeaddress,
                    'city'		                =>	$userCreated->city,
                    'country'		            =>	$userCreated->country,
                    'photo'		                =>	$userCreated->photo,
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
    // third
    return $response;
});