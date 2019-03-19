<?php
use Phalcon\Http\Response;
// -------------------------- POST ONE ADMINISTRATOR --------------------------
$app->post('/api/v1/admins', function () use ($app) {
    // first
    $admin = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheckIdAdmin = 'SELECT idadmin FROM Admin WHERE idadmin = :idadmin:';

    $adminCheckId = $app->modelsManager->executeQuery(
        $phqlCheckIdAdmin,
        [
            'idadmin' => $admin->idadmin,
        ]
    )->getFirst();

    if((is_object($adminCheckId)) and ($adminCheckId->idadmin === $admin->idadmin)) {
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "administrator can not be created",
            'idadmin' => "idadmin must be unique",
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
        //
        $phql = 'INSERT INTO Admin (idadmin, fname, lname, email, username, password, status, type, pswupdatecode, pswupdatelink,
                                datecreation, lastupdatedate, lastlogindate, description, otherinfo, datebirth, gender, phonenumber) 
                  VALUES (:idadmin:, :fname:, :lname:, :email:, :username:, :password:, :status:, :type:, :pswupdatecode:, :pswupdatelink:, 
                          :datecreation:, :lastupdatedate:, :lastlogindate:, :description:, :otherinfo:, :datebirth:, :gender:, :phonenumber:)';
        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'idadmin'				    =>	$admin->idadmin,
                'fname'		                =>	$admin->fname,
                'lname'			            =>	$admin->lname,
                'email'	                    =>	$admin->email,
                'username'	                =>	$admin->username,
                'password'			        =>	$admin->password,
                'status'		            =>	$admin->status,
                'type'			            =>	$admin->type,
                'pswupdatecode'	            =>	$admin->pswupdatecode,
                'pswupdatelink'	            =>	$admin->pswupdatelink,
                'datecreation'		        =>	$admin->datecreation,
                'lastupdatedate'		    =>	$admin->lastupdatedate,
                'lastlogindate'		        =>	$admin->lastlogindate,
                'description'		        =>	$admin->description,
                'otherinfo'		            =>	$admin->otherinfo,
                'datebirth'		            =>	$admin->datebirth,
                'gender'		            =>	$admin->gender,
                'phonenumber'		        =>	$admin->phonenumber
            ]
        );
        if($status->success() === true){
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');

            $admin->idadmin = $status->getModel()->idadmin;

            $response->setJsonContent([
                'status' => 'success',
                'messages' => "administrator created successfully",
                'data' => $admin,
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