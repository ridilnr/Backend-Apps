<?php
use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;
use Phalcon\Http\Response;
use Phalcon\Http\Request;
use Phalcon\Mvc\Url;

// Use Loader() to autoload our model
$loader = new Loader();

$loader->registerDirs(
    [
        __DIR__ . '/app/models/'
    ]
);

$loader->register();

$di = new FactoryDefault();

// Set up the database service
$di->set('db', function () {
    return new PdoMysql(
        [
            'adapter'     => 'Mysql',
            'host'        => 'mysql.anaxanet.com',
            'username'    => 'udzaylcc_jeanthierry',
            'password'    => 'Kktc000011#',
            'dbname'      => 'udzaylcc_foodapp',
            'charset'     => 'utf8',
        ]
    );
}
);

// Create and bind the DI to the application
$app = new Micro($di);

//
//$url = new Url();
/*
***************************** CRUD OPERATIONS OF "admin" TABLE *****************************
 */
// -------------------------- GET ALL ADMINISTRATORS --------------------------
$app->get('/api/v1/admins', function() use ($app) {
    // first
    $phql = 'SELECT * FROM Admin ORDER BY idadmin';

    $admins = $app->modelsManager->executeQuery($phql);

    $data = [];

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($admins) !== 0){
        foreach($admins as $admin) {
            $data[] = [
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
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'administrators exist',
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
            'messages' => 'administrators don\'t exist',
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
// -------------------------- GET ONE ADMINISTRATOR --------------------------
$app->get('/api/v1/admins/{idadmin}', function ($idadmin) use ($app) {
    // first
    $phql = 'SELECT * FROM Admin WHERE idadmin = :idadmin:';

    $admin = $app->modelsManager->executeQuery(
        $phql,
        [
            'idadmin' => $idadmin,
        ]
    )->getFirst();

    $data = [];


    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if($admin === false){
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "administrator with idadmin : ".$idadmin." doesn't exist",
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
            'messages' => "administrator with idadmin : ".$idadmin." exists",
            'data' => [
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
// -------------------------- UPDATE ONE ADMINISTRATOR --------------------------
$app->put('/api/v1/admins/{idadmin}', function ($idadmin) use ($app) {
    // first
    $admin = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = 'SELECT * FROM Admin WHERE idadmin = :idadmin:';

    $adminCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'idadmin' => $idadmin,
        ]
    )->getFirst();

    if($adminCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "administrator with idadmin : ".$idadmin." can not be updated because it doesn't exist",
        ]);
    }else{
        $phql = 'UPDATE Admin SET fname = :fname:, lname = :lname:, email = :email:, username = :username:, password = :password:, 
                                  status = :status:, type = :type:, pswupdatecode = :pswupdatecode:, pswupdatelink = :pswupdatelink:, 
                                  datecreation = :datecreation:, lastupdatedate = :lastupdatedate:, lastlogindate = :lastlogindate:, 
                                  description = :description:, otherinfo = :otherinfo:, datebirth = :datebirth:, gender = :gender:, phonenumber = :phonenumber: 
                  WHERE idadmin = :idadmin:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'idadmin'				    =>	$idadmin,
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
// -------------------------- DELETE ONE ADMINISTRATOR --------------------------
$app->delete('/api/v1/admins/{idadmin}', function ($idadmin) use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = 'SELECT * FROM Admin WHERE idadmin = :idadmin:';

    $adminCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'idadmin' => $idadmin,
        ]
    )->getFirst();

    if($adminCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "administrator with idadmin : ".$idadmin." can not be deleted because it doesn't exist",
        ]);
    }else{
        $phql = 'DELETE FROM Admin WHERE idadmin = :idadmin:';
        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'idadmin'				    =>	$idadmin
            ]
        );

        if($status->success() === true){
            // Change the HTTP status
            $response->setStatusCode(202, 'Accepted');
            $response->setJsonContent([
                'status' => "success",
                'messages' => "administrator with idadmin : ".$idadmin." has been deleted successfully",
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

/*
***************************** CRUD OPERATIONS OF "adminrestaurant" TABLE *****************************
 */

// -------------------------- GET ALL RESTAURANTS ADMINISTRATORS --------------------------
$app->get('/api/v1/adminrestaurants', function () use ($app) {
    // first
    $phql = 'SELECT * FROM Adminrestaurant ORDER BY idresto';

    $adminrestaurants = $app->modelsManager->executeQuery($phql);

    $data = [];

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($adminrestaurants)){
        foreach($adminrestaurants as $adminrestaurant) {
            $data[] = [
                'idresto'				    =>	$adminrestaurant->idresto,
                'email'	                    =>	$adminrestaurant->email,
                'username'	                =>	$adminrestaurant->username,
                'password'			        =>	$adminrestaurant->password,
                'status'		            =>	$adminrestaurant->status,
                'type'			            =>	$adminrestaurant->type,
                'pwupdatecode'	            =>	$adminrestaurant->pwupdatecode,
                'pwupdatelink'	            =>	$adminrestaurant->pwupdatelink,
                'datecreation'		        =>	$adminrestaurant->datecreation,
                'lastupdatedate'		    =>	$adminrestaurant->lastupdatedate,
                'lastlogindate'		        =>	$adminrestaurant->lastlogindate,
                'description'		        =>	$adminrestaurant->description,
                'otherinfo'		            =>	$adminrestaurant->otherinfo,
                'datebirth'		            =>	$adminrestaurant->datebirth,
                'gender'		            =>	$adminrestaurant->gender,
                'phonenumber'		        =>	$adminrestaurant->phonenumber,
                'restauname'		        =>	$adminrestaurant->restauname,
                'city'		                =>	$adminrestaurant->city,
                'country'		            =>	$adminrestaurant->country,
                'deliverystarttime'		    =>	$adminrestaurant->deliverystarttime,
                'deliverystoptime'		    =>	$adminrestaurant->deliverystoptime,
                'photo'		                =>	$adminrestaurant->photo,
                'address'		            =>	$adminrestaurant->address,
                'connectivity'		        =>	$adminrestaurant->connectivity,
                'restorate'		            =>	$adminrestaurant->restorate,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'restaurants administrators exist',
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
            'messages' => 'restaurants administrators don\'t exist',
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
// -------------------------- GET A RESTAURANT ADMINISTRATOR --------------------------
$app->get('/api/v1/adminrestaurants/{idresto}', function ($idresto) use ($app) {
    // first
    $phql = 'SELECT * FROM Adminrestaurant WHERE idresto = :idresto:';

    $adminrestaurant = $app->modelsManager->executeQuery(
        $phql,
        [
            'idresto' => $idresto
        ]
    )->getFirst();

    $data = [];

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if($adminrestaurant === false) {
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "restaurant administrator with idresto : ".$idresto." doesn't exist",
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
            'messages' => "restaurant administrator with idresto : ".$idresto."  exists",
            'data' => [
                'idresto'				    =>	$adminrestaurant->idresto,
                'email'	                    =>	$adminrestaurant->email,
                'username'	                =>	$adminrestaurant->username,
                'password'			        =>	$adminrestaurant->password,
                'status'		            =>	$adminrestaurant->status,
                'type'			            =>	$adminrestaurant->type,
                'pwupdatecode'	            =>	$adminrestaurant->pwupdatecode,
                'pwupdatelink'	            =>	$adminrestaurant->pwupdatelink,
                'datecreation'		        =>	$adminrestaurant->datecreation,
                'lastupdatedate'		    =>	$adminrestaurant->lastupdatedate,
                'lastlogindate'		        =>	$adminrestaurant->lastlogindate,
                'description'		        =>	$adminrestaurant->description,
                'otherinfo'		            =>	$adminrestaurant->otherinfo,
                'datebirth'		            =>	$adminrestaurant->datebirth,
                'gender'		            =>	$adminrestaurant->gender,
                'phonenumber'		        =>	$adminrestaurant->phonenumber,
                'restauname'		        =>	$adminrestaurant->restauname,
                'city'		                =>	$adminrestaurant->city,
                'country'		            =>	$adminrestaurant->country,
                'deliverystarttime'		    =>	$adminrestaurant->deliverystarttime,
                'deliverystoptime'		    =>	$adminrestaurant->deliverystoptime,
                'photo'		                =>	$adminrestaurant->photo,
                'address'		            =>	$adminrestaurant->address,
                'connectivity'		        =>	$adminrestaurant->connectivity,
                'restorate'		            =>	$adminrestaurant->restorate,
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
// -------------------------- POST A RESTAURANT ADMINISTRATOR --------------------------
$app->post('/api/v1/adminrestaurants', function () use ($app) {
    // first
    $adminrestaurant = $app->request->getJsonRawBody();

    // Create a response
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $phqlCheckIdResto = 'SELECT idresto FROM Adminrestaurant WHERE idresto = :idresto:';

    $adminCheckIdResto = $app->modelsManager->executeQuery(
        $phqlCheckIdResto,
        [
            'idresto' => $adminrestaurant->idresto,
        ]
    )->getFirst();

    if((is_object($adminCheckIdResto)) and ($adminCheckIdResto->idresto === $adminrestaurant->idresto)){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "restaurant administrator can not be created",
            'idresto' => "idresto must be unique",
        ]);
    }else{
        $phql = 'INSERT INTO Adminrestaurant (idresto, email, username, password, status, type, pwupdatecode, pwupdatelink, datecreation,
                                          lastupdatedate, lastlogindate, description, otherinfo, datebirth, gender, phonenumber,
                                          restauname, city, country, deliverystarttime, deliverystoptime, photo, address)
                 VALUES (:idresto:, :email:, :username:, :password:, :status:, :type:, :pwupdatecode:, :pwupdatelink:, :datecreation:,
                         :lastupdatedate:, :lastlogindate:, :description:, :otherinfo:, :datebirth:, :gender:, :phonenumber:, :restauname:,
                         :city:, :country:, :deliverystarttime:, :deliverystoptime:, :photo:, :address:)';
        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'idresto'				    =>	$adminrestaurant->idresto,
                'email'	                    =>	$adminrestaurant->email,
                'username'	                =>	$adminrestaurant->username,
                'password'			        =>	$adminrestaurant->password,
                'status'		            =>	$adminrestaurant->status,
                'type'			            =>	$adminrestaurant->type,
                'pwupdatecode'	            =>	$adminrestaurant->pwupdatecode,
                'pwupdatelink'	            =>	$adminrestaurant->pwupdatelink,
                'datecreation'		        =>	$adminrestaurant->datecreation,
                'lastupdatedate'		    =>	$adminrestaurant->lastupdatedate,
                'lastlogindate'		        =>	$adminrestaurant->lastlogindate,
                'description'		        =>	$adminrestaurant->description,
                'otherinfo'		            =>	$adminrestaurant->otherinfo,
                'datebirth'		            =>	$adminrestaurant->datebirth,
                'gender'		            =>	$adminrestaurant->gender,
                'phonenumber'		        =>	$adminrestaurant->phonenumber,
                'restauname'		        =>	$adminrestaurant->restauname,
                'city'		                =>	$adminrestaurant->city,
                'country'		            =>	$adminrestaurant->country,
                'deliverystarttime'		    =>	$adminrestaurant->deliverystarttime,
                'deliverystoptime'		    =>	$adminrestaurant->deliverystoptime,
                'photo'		                =>	$adminrestaurant->photo,
                'address'		            =>	$adminrestaurant->address,
                'connectivity'		        =>	$adminrestaurant->connectivity,
                'restorate'		            =>	$adminrestaurant->restorate,
            ]
        );
        // Check if the insertion was successful
        if($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');

            $adminrestaurant->idresto = $status->getModel()->idresto;

            $response->setJsonContent([
                'status' => 'success',
                'messages' => "restaurant administrator created successfully",
                'data' => $adminrestaurant,
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
// -------------------------- UPDATE A RESTAURANT ADMINISTRATOR --------------------------
$app->put('/api/v1/adminrestaurants/{idresto}', function ($idresto) use ($app) {
    // first
    $adminrestaurant = $app->request->getJsonRawBody();

    $data = [];

    // Create a response
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = 'SELECT * FROM Adminrestaurant WHERE idresto = :idresto:';

    $adminrestaurantCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'idresto' => $idresto,
        ]
    )->getFirst();

    if($adminrestaurantCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "restaurant administrator with idresto : ".$idresto." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Adminrestaurant SET email = :email:, username = :username:, password = :password:, status = :status:, type = :type:, 
                                            pwupdatecode = :pwupdatecode:, pwupdatelink = :pwupdatelink:, datecreation = :datecreation:, 
                                            lastupdatedate = :lastupdatedate:, lastlogindate = :lastlogindate:, description = :description:, otherinfo = :otherinfo:,
                                            datebirth = :datebirth:, gender = :gender:, phonenumber = :phonenumber:, restauname = :restauname:,city = :city:, country = :country:, 
                                            deliverystarttime = :deliverystarttime:, deliverystoptime = :deliverystoptime:, photo = :photo:, address = :address: 
                  WHERE idresto = :idresto:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'idresto'				    =>	$idresto,
                'email'	                    =>	$adminrestaurant->email,
                'username'	                =>	$adminrestaurant->username,
                'password'			        =>	$adminrestaurant->password,
                'status'		            =>	$adminrestaurant->status,
                'type'			            =>	$adminrestaurant->type,
                'pwupdatecode'	            =>	$adminrestaurant->pwupdatecode,
                'pwupdatelink'	            =>	$adminrestaurant->pwupdatelink,
                'datecreation'		        =>	$adminrestaurant->datecreation,
                'lastupdatedate'		    =>	$adminrestaurant->lastupdatedate,
                'lastlogindate'		        =>	$adminrestaurant->lastlogindate,
                'description'		        =>	$adminrestaurant->description,
                'otherinfo'		            =>	$adminrestaurant->otherinfo,
                'datebirth'		            =>	$adminrestaurant->datebirth,
                'gender'		            =>	$adminrestaurant->gender,
                'phonenumber'		        =>	$adminrestaurant->phonenumber,
                'restauname'		        =>	$adminrestaurant->restauname,
                'city'		                =>	$adminrestaurant->city,
                'country'		            =>	$adminrestaurant->country,
                'deliverystarttime'		    =>	$adminrestaurant->deliverystarttime,
                'deliverystoptime'		    =>	$adminrestaurant->deliverystoptime,
                'photo'		                =>	$adminrestaurant->photo,
                'address'		            =>	$adminrestaurant->address,
                'connectivity'		        =>	$adminrestaurant->connectivity,
                'restorate'		            =>	$adminrestaurant->restorate,
            ]
        );

        // Check if the insertion was successful
        if($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(204, 'No Content');
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
// -------------------------- DELETE A RESTAURANT ADMINISTRATOR --------------------------
$app->delete('/api/v1/adminrestaurants/{idresto}', function ($idresto) use ($app) {
    // first

    // Create a response
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = 'SELECT * FROM Adminrestaurant WHERE idresto = :idresto:';

    $adminrestaurantCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'idresto' => $idresto,
        ]
    )->getFirst();

    if($adminrestaurantCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "restaurant administrator with idresto : ".$idresto." can not be deleted because it doesn't exist",
        ]);
    }else{
        $phql = 'DELETE FROM Adminrestaurant WHERE idresto = :idresto:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'idresto'				    =>	$idresto,
            ]
        );

        // Check if the insertion was successful
        if($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(202, 'Accepted');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "restaurant administrator with idresto : ".$idresto." has been deleted successfully",
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

/*
***************************** CRUD OPERATIONS OF "cities" TABLE *****************************
 */

// -------------------------- GET ALL CITIES --------------------------
$app->get('/api/v1/cities', function () use ($app) {
    // first
    $phql = "SELECT * FROM Cities ORDER BY cityid";

    $cities = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($cities) !== 0){
        foreach($cities as $city) {
            $data[] = [
                'cityid'				    =>	$city->cityid,
                'cityname'		            =>	$city->cityname,
                'countryname'			    =>	$city->countryname,
                'description'	            =>	$city->description,
                'otherinfo'	                =>	$city->otherinfo,
                'status'			        =>	$city->status
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'cities exist',
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
            'messages' => 'cities don\'t exist',
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
// -------------------------- GET A CITY --------------------------
$app->get('/api/v1/cities/{cityid}', function ($cityid) use ($app) {
    // first
    $phql = "SELECT * FROM Cities WHERE cityid = :cityid:";

    $city = $app->modelsManager->executeQuery(
        $phql,
        [
            'cityid' => $cityid
        ]
    )->getFirst();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if($city === false){
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "city with cityid : ".$cityid." doesn't exist",
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
            'messages' => "city with cityid : ".$cityid." exists",
            'data' => [
                'cityid'				    =>	$city->cityid,
                'cityname'		            =>	$city->cityname,
                'countryname'			    =>	$city->countryname,
                'description'	            =>	$city->description,
                'otherinfo'	                =>	$city->otherinfo,
                'status'			        =>	$city->status
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

/*
***************************** CRUD OPERATIONS OF "countries" TABLE *****************************
 */

// -------------------------- GET ALL COUNTRIES --------------------------
$app->get('/api/v1/countries', function () use ($app) {
    // first
    $phql = "SELECT * FROM Countries ORDER BY cid";

    $countries = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($countries) !== 0){
        foreach($countries as $country) {
            $data[] = [
                'cid'				        =>	$country->cid,
                'countryname'		        =>	$country->countryname,
                'status'			        =>	$country->status
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'countries exist',
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
    }else {
        $response->setJsonContent([
            'status' => 'error',
            'messages' => 'countries don\'t exist',
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
// -------------------------- GET A COUNTRY --------------------------
$app->get('/api/v1/countries/{cid}', function ($cid) use ($app) {
    // first
    $phql = "SELECT * FROM Countries WHERE cid = :cid:";

    $country = $app->modelsManager->executeQuery(
        $phql,
        [
            'cid' => $cid
        ]
    )->getFirst();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if($country === false){
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "country with cid : ".$cid." doesn't exist",
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
            'messages' => "country with cid : ".$cid." exists",
            'data' => [
                'cid'				        =>	$country->cid,
                'countryname'		        =>	$country->countryname,
                'status'			        =>	$country->status
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
    return $response;
});
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
// -------------------------- UPDATE A COUNTRY --------------------------
$app->put('/api/v1/countries/{cid}', function ($cid) use ($app) {
    // first
    $country = $app->request->getJsonRawBody();

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
            'messages' => "country with cid : ".$cid." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Countries SET countryname = :countryname:, status = :status: 
                 WHERE cid = :cid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'cid'				        =>	$cid,
                'countryname'		        =>	$country->countryname,
                'status'			        =>	$country->status
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(204, 'No Content');
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

/*
***************************** CRUD OPERATIONS OF "customers" TABLE *****************************
 */

// -------------------------- GET ALL CUSTOMERS --------------------------
$app->get('/api/v1/customers', function () use ($app) {
    // first
    $phql = "SELECT * FROM Customers ORDER BY id";

    $customers = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($customers) !== 0){
        foreach($customers as $customer) {
            $data[] = [
                'id'				        =>	$customer->id,
                'userid'		            =>	$customer->userid,
                'fullname'			        =>	$customer->fullname,
                'email'			            =>	$customer->email,
                'phonenumber'			    =>	$customer->phonenumber,
                'city'			            =>	$customer->city,
                'address'			        =>	$customer->address,
                'idresto'			        =>	$customer->idresto,
                'photo'			            =>	$customer->photo,
                'customerrating'			=>	$customer->customerrating,
                'restorating'			    =>	$customer->restorating,
                'restocomments'			    =>	$customer->restocomments,
                'otherinfo'			        =>	$customer->otherinfo,
                'allownotifications'		=>	$customer->allownotifications,
                'membershipdate'			=>	$customer->membershipdate,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'customers exist',
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
    }else {
        $response->setJsonContent([
            'status' => 'error',
            'messages' => 'customers don\'t exist',
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
// -------------------------- GET A CUSTOMER --------------------------
$app->get('/api/v1/customers/{id}', function ($id) use ($app) {
    // first
    $phql = "SELECT * FROM Customers WHERE id = :id:";

    $customer = $app->modelsManager->executeQuery(
        $phql,
        [
            'id' => $id
        ]
    )->getFirst();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if($customer === false){
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "customer with id : ".$id." doesn't exist",
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
            'messages' => "customer with id : ".$id." exists",
            'data' => [
                'id'				        =>	$customer->id,
                'userid'		            =>	$customer->userid,
                'fullname'			        =>	$customer->fullname,
                'email'			            =>	$customer->email,
                'phonenumber'			    =>	$customer->phonenumber,
                'city'			            =>	$customer->city,
                'address'			        =>	$customer->address,
                'idresto'			        =>	$customer->idresto,
                'photo'			            =>	$customer->photo,
                'customerrating'			=>	$customer->customerrating,
                'restorating'			    =>	$customer->restorating,
                'restocomments'			    =>	$customer->restocomments,
                'otherinfo'			        =>	$customer->otherinfo,
                'allownotifications'		=>	$customer->allownotifications,
                'membershipdate'			=>	$customer->membershipdate,
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
    return $response;
});
// -------------------------- POST A CUSTOMER --------------------------
$app->post('/api/v1/customers', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $customer = $app->request->getJsonRawBody();

    $phqlCheckId = 'SELECT id FROM Customers WHERE id = :id:';

    $customerCheckId = $app->modelsManager->executeQuery(
        $phqlCheckId,
        [
            'id' => $customer->id,
        ]
    )->getFirst();

    if((is_object($customerCheckId)) and ($customerCheckId->id === $customer->id)) {
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "customer can not be created",
            'id' => "id must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Customers (id, userid, fullname, email, phonenumber, city, address, idresto, photo, customerrating,
                                    restorating, restocomments, otherinfo, allownotifications, membershipdate) 
             VALUES (:id:, :userid:, :fullname:, :email:, :phonenumber:, :city:, :address:, :idresto:, :photo:, :customerrating:, 
                     :restorating:, :restocomments:, :otherinfo:, :allownotifications:, :membershipdate:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				        =>	$customer->id,
                'userid'		            =>	$customer->userid,
                'fullname'			        =>	$customer->fullname,
                'email'			            =>	$customer->email,
                'phonenumber'			    =>	$customer->phonenumber,
                'city'			            =>	$customer->city,
                'address'			        =>	$customer->address,
                'idresto'			        =>	$customer->idresto,
                'photo'			            =>	$customer->photo,
                'customerrating'			=>	$customer->customerrating,
                'restorating'			    =>	$customer->restorating,
                'restocomments'			    =>	$customer->restocomments,
                'otherinfo'			        =>	$customer->otherinfo,
                'allownotifications'		=>	$customer->allownotifications,
                'membershipdate'			=>	$customer->membershipdate,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');

            $response->setJsonContent([
                'status' => 'success',
                'messages' => "customer created successfully",
                'data' => $customer,
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
// -------------------------- UPDATE A CUSTOMER --------------------------
$app->put('/api/v1/customers/{id}', function ($id) use ($app) {
    // first
    $customer = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Customers WHERE id = :id:";

    $customerCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'id' => $id
        ]
    )->getFirst();

    if($customerCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "customer with id : ".$id." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Customers SET userid = :userid:, fullname = :fullname:, email = :email:, phonenumber = :phonenumber:, 
                                      city = :city:, address = :address:, idresto = :idresto:, photo = :photo:, customerrating = :customerrating:, 
                                      restorating = :restorating:, restocomments = :restocomments:, otherinfo = :otherinfo:, 
                                      allownotifications = :allownotifications:, membershipdate = :membershipdate: 
                 WHERE id = :id:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				        =>	$id,
                'userid'		            =>	$customer->userid,
                'fullname'			        =>	$customer->fullname,
                'email'			            =>	$customer->email,
                'phonenumber'			    =>	$customer->phonenumber,
                'city'			            =>	$customer->city,
                'address'			        =>	$customer->address,
                'idresto'			        =>	$customer->idresto,
                'photo'			            =>	$customer->photo,
                'customerrating'			=>	$customer->customerrating,
                'restorating'			    =>	$customer->restorating,
                'restocomments'			    =>	$customer->restocomments,
                'otherinfo'			        =>	$customer->otherinfo,
                'allownotifications'		=>	$customer->allownotifications,
                'membershipdate'			=>	$customer->membershipdate,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(204, 'No Content');
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
// -------------------------- DELETE A CUSTOMER --------------------------
$app->delete('/api/v1/customers/{id}', function ($id) use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Customers WHERE id = :id:";

    $customerCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'id' => $id
        ]
    )->getFirst();

    if($customerCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "customer with cid : ".$id." can not be deleted because it doesn't exist",
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
        $phql = 'DELETE FROM Customers WHERE id = :id:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				        =>	$id,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(202, 'Accepted');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "customer with id : ".$id." has been deleted successfully",
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
                ]
            );
        }
    }
    return $response;
});

/*
***************************** CRUD OPERATIONS OF "drinks" TABLE *****************************
 */

// -------------------------- GET ALL DRINKS --------------------------
$app->get('/api/v1/drinks', function () use ($app) {
    // first
    $phql = "SELECT * FROM Drinks ORDER BY drinkid";

    $drinks = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($drinks) !== 0){
        foreach($drinks as $drink) {
            $data[] = [
                'drinkid'				    =>	$drink->drinkid,
                'restoid'		            =>	$drink->restoid,
                'restauname'			    =>	$drink->restauname,
                'drinkname'	                =>	$drink->drinkname,
                'type'			            =>	$drink->type,
                'price'			            =>	$drink->price,
                'available'	                =>	$drink->available,
                'dateinserted'	            =>	$drink->dateinserted,
                'lastupdateddate'		    =>	$drink->lastupdateddate,
                'discount'		            =>	$drink->discount,
                'description'		        =>	$drink->description,
                'size'		                =>	$drink->size,
                'photo'	                    =>	$drink->photo
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'drinks exist',
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
    }else {
        $response->setJsonContent([
            'status' => 'error',
            'messages' => 'drinks don\'t exist',
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
// -------------------------- GET ALL DRINKS OF A RESTAURANT --------------------------
$app->get('/api/v1/restaurant/drinks/{restoid}', function ($restoid) use ($app) {
    // first
    $phql = "SELECT * FROM Drinks WHERE restoid = :restoid: ORDER BY drinkid";

    $drinks = $app->modelsManager->executeQuery(
        $phql,
        [
            'restoid' => $restoid
        ]
    );

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($drinks) !== 0){
        foreach($drinks as $drink) {
            $data[] = [
                'drinkid'				    =>	$drink->drinkid,
                'restoid'		            =>	$drink->restoid,
                'restauname'			    =>	$drink->restauname,
                'drinkname'	                =>	$drink->drinkname,
                'type'			            =>	$drink->type,
                'price'			            =>	$drink->price,
                'available'	                =>	$drink->available,
                'dateinserted'	            =>	$drink->dateinserted,
                'lastupdateddate'		    =>	$drink->lastupdateddate,
                'discount'		            =>	$drink->discount,
                'description'		        =>	$drink->description,
                'size'		                =>	$drink->size,
                'photo'	                    =>	$drink->photo
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'drinks exist',
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
    }else {
        $response->setJsonContent([
            'status' => 'error',
            'messages' => 'drinks don\'t exist',
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
// -------------------------- GET A DRINK --------------------------
$app->get('/api/v1/drinks/{drinkid}', function ($drinkid) use ($app) {
    // first
    $phql = "SELECT * FROM Drinks WHERE drinkid = :drinkid:";

    $drink = $app->modelsManager->executeQuery(
        $phql,
        [
            'drinkid' => $drinkid
        ]
    )->getFirst();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if($drink === false){
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "drink with drinkid : ".$drinkid." doesn't exist",
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
            'messages' => "drink with drinkid : ".$drinkid." exists",
            'data' => [
                'drinkid'				    =>	$drink->drinkid,
                'restoid'		            =>	$drink->restoid,
                'restauname'			    =>	$drink->restauname,
                'drinkname'	                =>	$drink->drinkname,
                'type'			            =>	$drink->type,
                'price'			            =>	$drink->price,
                'available'	                =>	$drink->available,
                'dateinserted'	            =>	$drink->dateinserted,
                'lastupdateddate'		    =>	$drink->lastupdateddate,
                'discount'		            =>	$drink->discount,
                'description'		        =>	$drink->description,
                'size'		                =>	$drink->size,
                'photo'	                    =>	$drink->photo
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
// -------------------------- POST A DRINK --------------------------
$app->post('/api/v1/drinks', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $drink = $app->request->getJsonRawBody();

    $phqlCheckDrinkId = 'SELECT drinkid FROM Drinks WHERE drinkid = :drinkid:';

    $drinkCheckId = $app->modelsManager->executeQuery(
        $phqlCheckDrinkId,
        [
            'drinkid' => $drink->drinkid,
        ]
    )->getFirst();

    if((is_object($drinkCheckId)) and ($drinkCheckId->drinkid === $drink->drinkid)) {
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "drink can not be created",
            'drinkid' => "drinkid must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Drinks (drinkid, restoid, restauname, drinkname, type, price,  available, dateinserted, lastupdateddate, discount, description, size, photo)
                 VALUES (:drinkid:, :restoid:, :restauname:, :drinkname:, :type:, :price:, :available:, :dateinserted:, :lastupdateddate:, :discount:, :description:, :size:, :photo:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'drinkid'				    =>	$drink->drinkid,
                'restoid'		            =>	$drink->restoid,
                'restauname'			    =>	$drink->restauname,
                'drinkname'	                =>	$drink->drinkname,
                'type'			            =>	$drink->type,
                'price'			            =>	$drink->price,
                'available'	                =>	$drink->available,
                'dateinserted'	            =>	$drink->dateinserted,
                'lastupdateddate'		    =>	$drink->lastupdateddate,
                'discount'		            =>	$drink->discount,
                'description'		        =>	$drink->description,
                'size'		                =>	$drink->size,
                'photo'	                    =>	$drink->photo
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "drink created successfully",
                'data' => $drink,
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
// -------------------------- UPDATE A DRINK --------------------------
$app->put('/api/v1/drinks/{drinkid}', function ($drinkid) use ($app) {
    // first
    $drink = $app->request->getJsonRawBody();

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
            'messages' => "drink with drinkid : ".$drinkid." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Drinks SET restoid = :restoid:, restauname = :restauname:, drinkname = :drinkname:, type = :type:, price = :price:, 
                               available = :available:, dateinserted = :dateinserted:, lastupdateddate = :lastupdateddate:, discount = :discount:, 
                               description = :description:, size = :size:, photo = :photo: 
             WHERE drinkid = :drinkid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'drinkid'				    =>	$drinkid,
                'restoid'		            =>	$drink->restoid,
                'restauname'			    =>	$drink->restauname,
                'drinkname'	                =>	$drink->drinkname,
                'type'			            =>	$drink->type,
                'price'			            =>	$drink->price,
                'available'	                =>	$drink->available,
                'dateinserted'	            =>	$drink->dateinserted,
                'lastupdateddate'		    =>	$drink->lastupdateddate,
                'discount'		            =>	$drink->discount,
                'description'		        =>	$drink->description,
                'size'		                =>	$drink->size,
                'photo'	                    =>	$drink->photo
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(204, 'No Content');
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

/*
***************************** CRUD OPERATIONS OF "foods" TABLE *****************************
 */

// -------------------------- GET ALL FOODS OF ALL RESTAURANTS --------------------------
$app->get('/api/v1/foods', function () use ($app) {
    // first
    $phql = "SELECT * FROM Foods ORDER BY foodid";

    $foods = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($foods) !== 0){
        foreach($foods as $food) {
            $data[] = [
                'foodid'				    =>	$food->foodid,
                'restoid'		            =>	$food->restoid,
                'restauname'			    =>	$food->restauname,
                'foodname'	                =>	$food->foodname,
                'photo'	                    =>	$food->photo,
                'price'			            =>	$food->price,
                'description'		        =>	$food->description,
                'type'			            =>	$food->type,
                'available'	                =>	$food->available,
                'dateinserted'	            =>	$food->dateinserted,
                'lastupdateddate'		    =>	$food->lastupdateddate,
                'discount'		            =>	$food->discount,
                'size'		                =>	$food->size
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'foods exist',
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
    }else {
        $response->setJsonContent([
            'status' => 'error',
            'messages' => 'foods don\'t exist',
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
// -------------------------- GET ALL FOODS OF A RESTAURANT --------------------------
$app->get('/api/v1/restaurant/foods/{restoid}', function ($restoid) use ($app) {
    // first
    $phql = "SELECT * FROM Foods WHERE restoid = :restoid:  ORDER BY foodid";


    $foods = $app->modelsManager->executeQuery(
        $phql,
        [
            'restoid' => $restoid
        ]
    );

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($foods) !== 0){
        foreach($foods as $food) {
            $data[] = [
                'foodid'				    =>	$food->foodid,
                'restoid'		            =>	$food->restoid,
                'restauname'			    =>	$food->restauname,
                'foodname'	                =>	$food->foodname,
                'photo'	                    =>	$food->photo,
                'price'			            =>	$food->price,
                'description'		        =>	$food->description,
                'type'			            =>	$food->type,
                'available'	                =>	$food->available,
                'dateinserted'	            =>	$food->dateinserted,
                'lastupdateddate'		    =>	$food->lastupdateddate,
                'discount'		            =>	$food->discount,
                'size'		                =>	$food->size
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'foods exist',
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
    }else {
        $response->setJsonContent([
            'status' => 'error',
            'messages' => 'foods don\'t exist',
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
// -------------------------- GET A FOOD --------------------------
$app->get('/api/v1/foods/{foodid}', function ($foodid) use ($app) {
    // first
    $phql = "SELECT * FROM Foods WHERE foodid = :foodid:";

    $food = $app->modelsManager->executeQuery(
        $phql,
        [
            'foodid' => $foodid
        ]
    )->getFirst();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if($food === false){
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "food with foodid : ".$foodid." doesn't exist",
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
            'messages' => "food with foodid : ".$foodid." exists",
            'data' => [
                'foodid'				    =>	$food->foodid,
                'restoid'		            =>	$food->restoid,
                'restauname'			    =>	$food->restauname,
                'foodname'	                =>	$food->foodname,
                'photo'	                    =>	$food->photo,
                'price'			            =>	$food->price,
                'description'		        =>	$food->description,
                'type'			            =>	$food->type,
                'available'	                =>	$food->available,
                'dateinserted'	            =>	$food->dateinserted,
                'lastupdateddate'		    =>	$food->lastupdateddate,
                'discount'		            =>	$food->discount,
                'size'		                =>	$food->size
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
// -------------------------- POST A FOOD --------------------------
$app->post('/api/v1/foods', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $food = $app->request->getJsonRawBody();

    $phqlCheckfoodid = 'SELECT foodid FROM Foods WHERE foodid = :foodid:';

    $foodCheckId = $app->modelsManager->executeQuery(
        $phqlCheckfoodid,
        [
            'foodid' => $food->foodid,
        ]
    )->getFirst();

    if((is_object($foodCheckId)) and ($foodCheckId->foodid === $food->foodid)){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "food can not be created",
            'foodid' => "foodid must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Foods (foodid, restoid, restauname, foodname, photo, price, description, type,  available, dateinserted, lastupdateddate, discount, size)
                 VALUES (:foodid:, :restoid:, :restauname:, :foodname:, :photo:, :price:, :description:, :type:, :available:, :dateinserted:, :lastupdateddate:, :discount:, :size:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'foodid'				    =>	$food->foodid,
                'restoid'		            =>	$food->restoid,
                'restauname'			    =>	$food->restauname,
                'foodname'	                =>	$food->foodname,
                'photo'	                    =>	$food->photo,
                'price'			            =>	$food->price,
                'description'		        =>	$food->description,
                'type'			            =>	$food->type,
                'available'	                =>	$food->available,
                'dateinserted'	            =>	$food->dateinserted,
                'lastupdateddate'		    =>	$food->lastupdateddate,
                'discount'		            =>	$food->discount,
                'size'		                =>	$food->size
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "food created successfully",
                'data' => $food,
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
// -------------------------- UPDATE A FOOD --------------------------
$app->put('/api/v1/foods/{foodid}', function ($foodid) use ($app) {
    // first
    $food = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Foods WHERE foodid = :foodid:";

    $foodCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'foodid' => $foodid
        ]
    )->getFirst();

    if($foodCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "food with foodid : ".$foodid." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Foods SET restoid = :restoid:, restauname = :restauname:, foodname = :foodname:, photo = :photo:, 
                                  price = :price:, description = :description:, type = :type:, available = :available:, 
                                  dateinserted = :dateinserted:, lastupdateddate = :lastupdateddate:, discount = :discount:, size = :size: 
                 WHERE foodid = :foodid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'foodid'				    =>	$foodid,
                'restoid'		            =>	$food->restoid,
                'restauname'			    =>	$food->restauname,
                'foodname'	                =>	$food->foodname,
                'photo'	                    =>	$food->photo,
                'price'			            =>	$food->price,
                'description'		        =>	$food->description,
                'type'			            =>	$food->type,
                'available'	                =>	$food->available,
                'dateinserted'	            =>	$food->dateinserted,
                'lastupdateddate'		    =>	$food->lastupdateddate,
                'discount'		            =>	$food->discount,
                'size'		                =>	$food->size
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(204, 'No Content');
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
// -------------------------- DELETE A FOOD --------------------------
$app->delete('/api/v1/foods/{foodid}', function ($foodid) use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Foods WHERE foodid = :foodid:";

    $foodCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'foodid' => $foodid
        ]
    )->getFirst();

    if($foodCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "food with foodid : ".$foodid." can not be deleted because it doesn't exist",
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
        $phql = 'DELETE FROM Foods WHERE foodid = :foodid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'foodid'				    =>	$foodid,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(202, 'Accepted');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "food with foodid : ".$foodid." has been deleted successfully",
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

/*
***************************** CRUD OPERATIONS OF "oldorderdrink" TABLE *****************************
 */

// -------------------------- GET ALL OLD DRINK ORDERS OF A USER --------------------------
$app->get('/api/v1/user/oldorderdrinks/{userid}', function ($userid) use ($app) {
    // first
    $phql = "SELECT * FROM Oldorderdrink WHERE userid = :userid: ORDER BY id";

    $oldorderdrinks = $app->modelsManager->executeQuery(
        $phql,
        [
            'userid' => $userid,
        ]
    );

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if(sizeof($oldorderdrinks) !== 0){
        foreach($oldorderdrinks as $ood) {
            $data[] = [
                'id'				        =>	$ood->id,
                'orderid'				    =>	$ood->orderid,
                'ordercode'		            =>	$ood->ordercode,
                'drinkid'		            =>	$ood->drinkid,
                'drinkname'		            =>	$ood->drinkname,
                'drinkprice'		        =>	$ood->drinkprice,
                'drinkqty'		            =>	$ood->drinkqty,
                'orderdate'		            =>	$ood->orderdate,
                'ordertime'			        =>	$ood->ordertime,
                'expectedtime'	            =>	$ood->expectedtime,
                'afterminutes'	            =>	$ood->afterminutes,
                'status'			        =>	$ood->status,
                'userid'		            =>	$ood->userid,
                'orderyear'		            =>	$ood->orderyear,
                'ordermonth'		        =>	$ood->ordermonth,
                'orderday'		            =>	$ood->orderday,
                'restauname'		        =>	$ood->restauname,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'old drink orders exist',
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
            'messages' => 'old drink orders don\'t exist',
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
// -------------------------- GET ALL OLD DRINK ORDERS --------------------------
$app->get('/api/v1/oldorderdrinks', function () use ($app) {
    // first
    $phql = "SELECT * FROM Oldorderdrink ORDER BY id";

    $oldorderdrinks = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if(sizeof($oldorderdrinks) !== 0){
        foreach($oldorderdrinks as $ood) {
            $data[] = [
                'id'				        =>	$ood->id,
                'orderid'				    =>	$ood->orderid,
                'ordercode'		            =>	$ood->ordercode,
                'drinkid'		            =>	$ood->drinkid,
                'drinkname'		            =>	$ood->drinkname,
                'drinkprice'		        =>	$ood->drinkprice,
                'drinkqty'		            =>	$ood->drinkqty,
                'orderdate'		            =>	$ood->orderdate,
                'ordertime'			        =>	$ood->ordertime,
                'expectedtime'	            =>	$ood->expectedtime,
                'afterminutes'	            =>	$ood->afterminutes,
                'status'			        =>	$ood->status,
                'userid'		            =>	$ood->userid,
                'orderyear'		            =>	$ood->orderyear,
                'ordermonth'		        =>	$ood->ordermonth,
                'orderday'		            =>	$ood->orderday,
                'restauname'		        =>	$ood->restauname,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'old drink orders exist',
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
            'messages' => 'old drink orders don\'t exist',
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

// -------------------------- GET AN OLD DRINK ORDER --------------------------
$app->get('/api/v1/oldorderdrinks/{id}', function ($id) use ($app) {
    // first
    $phqlA = "SELECT * FROM Oldorderdrink WHERE id = :id:";

    $phqlB = "SELECT * FROM Oldorderdrink WHERE orderid = :orderid:";

    $phqlC = "SELECT * FROM Oldorderdrink WHERE ordercode = :ordercode:";

    $phqlD = "SELECT * FROM Oldorderdrink WHERE userid = :userid:";

    $orderDrinkOne = $app->modelsManager->executeQuery(
        $phqlA,
        [
            'id' => $id,
        ]
    )->getFirst();

    $orderDrinkTwo = $app->modelsManager->executeQuery(
        $phqlB,
        [
            'orderid' => $id,
        ]
    );

    $orderDrinkThree = $app->modelsManager->executeQuery(
        $phqlC,
        [
            'ordercode' => $id,
        ]
    );

    $orderDrinkFour = $app->modelsManager->executeQuery(
        $phqlD,
        [
            'userid' => $id,
        ]
    );

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if($orderDrinkOne === false){
        if(sizeof($orderDrinkTwo) === 0){
            if(sizeof($orderDrinkThree) === 0){
                if(sizeof($orderDrinkFour) === 0){
                    $response->setStatusCode(406, 'Not Acceptable');
                    $response->setJsonContent([
                        'status' => 'error',
                        'messages' => "old drink order with parameter : ".$id." doesn't exist",
                        'data' => array(),
                    ]);
                }else {
                    foreach ($orderDrinkFour as $odf) {
                        $data[] = [
                            'id'				        =>	$odf->id,
                            'orderid'				    =>	$odf->orderid,
                            'ordercode'		            =>	$odf->ordercode,
                            'drinkid'		            =>	$odf->drinkid,
                            'drinkname'		            =>	$odf->drinkname,
                            'drinkprice'		        =>	$odf->drinkprice,
                            'drinkqty'		            =>	$odf->drinkqty,
                            'orderdate'		            =>	$odf->orderdate,
                            'ordertime'			        =>	$odf->ordertime,
                            'expectedtime'	            =>	$odf->expectedtime,
                            'afterminutes'	            =>	$odf->afterminutes,
                            'status'			        =>	$odf->status,
                            'userid'		            =>	$odf->userid,
                            'orderyear'		            =>	$odf->orderyear,
                            'ordermonth'		        =>	$odf->ordermonth,
                            'orderday'		            =>	$odf->orderday,
                            'restauname'		        =>	$odf->restauname,
                        ];
                    }
                    $response->setJsonContent([
                        'status' => 'success',
                        'messages' => "old drink order with parameter : ".$id." exists",
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
            }else{
                foreach ($orderDrinkThree as $odt) {
                    $data[] = [
                        'id'				        =>	$odt->id,
                        'orderid'				    =>	$odt->orderid,
                        'ordercode'		            =>	$odt->ordercode,
                        'drinkid'		            =>	$odt->drinkid,
                        'drinkname'		            =>	$odt->drinkname,
                        'drinkprice'		        =>	$odt->drinkprice,
                        'drinkqty'		            =>	$odt->drinkqty,
                        'orderdate'		            =>	$odt->orderdate,
                        'ordertime'			        =>	$odt->ordertime,
                        'expectedtime'	            =>	$odt->expectedtime,
                        'afterminutes'	            =>	$odt->afterminutes,
                        'status'			        =>	$odt->status,
                        'userid'		            =>	$odt->userid,
                        'orderyear'		            =>	$odt->orderyear,
                        'ordermonth'		        =>	$odt->ordermonth,
                        'orderday'		            =>	$odt->orderday,
                        'restauname'		        =>	$odt->restauname,
                    ];
                }
                $response->setJsonContent([
                    'status' => 'success',
                    'messages' => "old drink order with parameter : ".$id." exists",
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
        }else{
            foreach ($orderDrinkTwo as $odt) {
                $data[] = [
                    'id'				        =>	$odt->id,
                    'orderid'				    =>	$odt->orderid,
                    'ordercode'		            =>	$odt->ordercode,
                    'drinkid'		            =>	$odt->drinkid,
                    'drinkname'		            =>	$odt->drinkname,
                    'drinkprice'		        =>	$odt->drinkprice,
                    'drinkqty'		            =>	$odt->drinkqty,
                    'orderdate'		            =>	$odt->orderdate,
                    'ordertime'			        =>	$odt->ordertime,
                    'expectedtime'	            =>	$odt->expectedtime,
                    'afterminutes'	            =>	$odt->afterminutes,
                    'status'			        =>	$odt->status,
                    'userid'		            =>	$odt->userid,
                    'orderyear'		            =>	$odt->orderyear,
                    'ordermonth'		        =>	$odt->ordermonth,
                    'orderday'		            =>	$odt->orderday,
                    'restauname'		        =>	$odt->restauname,
                ];
            }
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "old drink order with parameter : ".$id." exists",
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
    }else{
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "old drink order with parameter : ".$id." exists",
            'data' => [
                'id'				        =>	$orderDrinkOne->id,
                'orderid'				    =>	$orderDrinkOne->orderid,
                'ordercode'		            =>	$orderDrinkOne->ordercode,
                'drinkid'		            =>	$orderDrinkOne->drinkid,
                'drinkname'		            =>	$orderDrinkOne->drinkname,
                'drinkprice'		        =>	$orderDrinkOne->drinkprice,
                'drinkqty'		            =>	$orderDrinkOne->drinkqty,
                'orderdate'		            =>	$orderDrinkOne->orderdate,
                'ordertime'			        =>	$orderDrinkOne->ordertime,
                'expectedtime'	            =>	$orderDrinkOne->expectedtime,
                'afterminutes'	            =>	$orderDrinkOne->afterminutes,
                'status'			        =>	$orderDrinkOne->status,
                'userid'		            =>	$orderDrinkOne->userid,
                'orderyear'		            =>	$orderDrinkOne->orderyear,
                'ordermonth'		        =>	$orderDrinkOne->ordermonth,
                'orderday'		            =>	$orderDrinkOne->orderday,
                'restauname'		        =>	$orderDrinkOne->restauname,
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
// -------------------------- POST AN OLD DRINK ORDER --------------------------
$app->post('/api/v1/oldorderdrinks', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $orderDrink = $app->request->getJsonRawBody();

    $phqlCheckOrderId = 'SELECT id FROM Oldorderdrink WHERE id = :id:';

    $orderDrinkCheckId = $app->modelsManager->executeQuery(
        $phqlCheckOrderId,
        [
            'id' => $orderDrink->id,
        ]
    )->getFirst();

    if((is_object($orderDrinkCheckId)) and ($orderDrinkCheckId->id === $orderDrink->id)){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "old drink order can not be created",
            'id' => "id must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Oldorderdrink (id, orderid, ordercode, drinkid, drinkname, drinkprice, drinkqty, orderdate, ordertime, 
                                         expectedtime, afterminutes, status, userid, orderyear, ordermonth, orderday, restauname) 
                  VALUES(:id:, :orderid:, :ordercode:, :drinkid:, :drinkname:, :drinkprice:, :drinkqty:, :orderdate:, :ordertime:, 
                         :expectedtime:, :afterminutes:, :status:, :userid:, :orderyear:, :ordermonth:, :orderday:, :restauname:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				        =>	$orderDrink->id,
                'orderid'				    =>	$orderDrink->orderid,
                'ordercode'		            =>	$orderDrink->ordercode,
                'drinkid'		            =>	$orderDrink->drinkid,
                'drinkname'		            =>	$orderDrink->drinkname,
                'drinkprice'		        =>	$orderDrink->drinkprice,
                'drinkqty'		            =>	$orderDrink->drinkqty,
                'orderdate'		            =>	$orderDrink->orderdate,
                'ordertime'			        =>	$orderDrink->ordertime,
                'expectedtime'	            =>	$orderDrink->expectedtime,
                'afterminutes'	            =>	$orderDrink->afterminutes,
                'status'			        =>	$orderDrink->status,
                'userid'		            =>	$orderDrink->userid,
                'orderyear'		            =>	$orderDrink->orderyear,
                'ordermonth'		        =>	$orderDrink->ordermonth,
                'orderday'		            =>	$orderDrink->orderday,
                'restauname'		        =>	$orderDrink->restauname,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "old drink order created successfully",
                'data' => $orderDrink,
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
// -------------------------- UPDATE AN OLD DRINK ORDER --------------------------
$app->put('/api/v1/oldorderdrinks/{id}', function ($id) use ($app) {
    // first
    $orderDrink = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Oldorderdrink WHERE id = :id:";

    $orderCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'id' => $id
        ]
    )->getFirst();

    if($orderCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "old order with id : ".$id." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Oldorderdrink SET orderid = :orderid:, ordercode = :ordercode:, drinkid = :drinkid:, drinkname = :drinkname:, 
                                       drinkprice = :drinkprice:, drinkqty = :drinkqty:, orderdate = :orderdate:, ordertime = :ordertime:, 
                                       expectedtime = :expectedtime:, afterminutes = :afterminutes:, status = :status:, userid = :userid:, 
                                       orderyear = :orderyear:, ordermonth = :ordermonth:, orderday = :orderday:, restauname = :restauname: 
                  WHERE id = :id:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				        =>	$id,
                'orderid'				    =>	$orderDrink->orderid,
                'ordercode'		            =>	$orderDrink->ordercode,
                'drinkid'		            =>	$orderDrink->drinkid,
                'drinkname'		            =>	$orderDrink->drinkname,
                'drinkprice'		        =>	$orderDrink->drinkprice,
                'drinkqty'		            =>	$orderDrink->drinkqty,
                'orderdate'		            =>	$orderDrink->orderdate,
                'ordertime'			        =>	$orderDrink->ordertime,
                'expectedtime'	            =>	$orderDrink->expectedtime,
                'afterminutes'	            =>	$orderDrink->afterminutes,
                'status'			        =>	$orderDrink->status,
                'userid'		            =>	$orderDrink->userid,
                'orderyear'		            =>	$orderDrink->orderyear,
                'ordermonth'		        =>	$orderDrink->ordermonth,
                'orderday'		            =>	$orderDrink->orderday,
                'restauname'		        =>	$orderDrink->restauname,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(204, 'No Content');
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
// -------------------------- DELETE AN OLD DRINK ORDER --------------------------
$app->delete('/api/v1/oldorderdrinks/{id}', function ($id) use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    //
    $phqlCheck = "SELECT * FROM Oldorderdrink WHERE id = :id:";

    $orderDrinkCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'id' => $id
        ]
    )->getFirst();

    if($orderDrinkCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "old drink order with id : ".$id." can not be deleted because it doesn't exist",
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
        $phql = 'DELETE FROM Oldorderdrink WHERE id = :id:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				    =>	$id,
            ]
        );

        // Check if the deletion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(202, 'Accepted');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "old drink order with id : ".$id." has been deleted successfully",
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

/*
***************************** CRUD OPERATIONS OF "oldorderfood" TABLE *****************************
 */

// -------------------------- GET ALL OLD FOOD ORDERS OF A USER --------------------------
$app->get('/api/v1/user/oldorderfoods/{userid}', function ($userid) use ($app) {
    // first
    $phql = "SELECT * FROM Oldorderfood WHERE userid = :userid: ORDER BY orderid";

    $oldorderfoods = $app->modelsManager->executeQuery(
        $phql,
        [
            'userid' => $userid,
        ]
    );

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if(sizeof($oldorderfoods) !== 0){
        foreach($oldorderfoods as $oof) {
            $data[] = [
                'orderid'				    =>	$oof->orderid,
                'orderdate'		            =>	$oof->orderdate,
                'ordertime'			        =>	$oof->ordertime,
                'expectedtime'	            =>	$oof->expectedtime,
                'afterminutes'	            =>	$oof->afterminutes,
                'status'			        =>	$oof->status,
                'restauname'		        =>	$oof->restauname,
                'foodid'		            =>	$oof->foodid,
                'foodname'		            =>	$oof->foodname,
                'foodprice'		            =>	$oof->foodprice,
                'foodqty'		            =>	$oof->foodqty,
                'userid'		            =>	$oof->userid,
                'orderyear'		            =>	$oof->orderyear,
                'ordermonth'		        =>	$oof->ordermonth,
                'orderday'		            =>	$oof->orderday,
                'ordercode'		            =>	$oof->ordercode,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'old food orders exist',
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
            'messages' => 'old food orders don\'t exist',
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

// -------------------------- GET ALL OLD FOOD ORDERS --------------------------
$app->get('/api/v1/oldorderfoods', function () use ($app) {
    // first
    $phql = "SELECT * FROM Oldorderfood ORDER BY orderid";

    $oldorderfoods = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if(sizeof($oldorderfoods) !== 0){
        foreach($oldorderfoods as $oof) {
            $data[] = [
                'orderid'				    =>	$oof->orderid,
                'orderdate'		            =>	$oof->orderdate,
                'ordertime'			        =>	$oof->ordertime,
                'expectedtime'	            =>	$oof->expectedtime,
                'afterminutes'	            =>	$oof->afterminutes,
                'status'			        =>	$oof->status,
                'restauname'		        =>	$oof->restauname,
                'foodid'		            =>	$oof->foodid,
                'foodname'		            =>	$oof->foodname,
                'foodprice'		            =>	$oof->foodprice,
                'foodqty'		            =>	$oof->foodqty,
                'userid'		            =>	$oof->userid,
                'orderyear'		            =>	$oof->orderyear,
                'ordermonth'		        =>	$oof->ordermonth,
                'orderday'		            =>	$oof->orderday,
                'ordercode'		            =>	$oof->ordercode,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'old food orders exist',
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
            'messages' => 'old food orders don\'t exist',
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

// -------------------------- GET AN OLD FOOD ORDER --------------------------
$app->get('/api/v1/oldorderfoods/{orderid}', function ($orderid) use ($app) {
    // first
    $phqlA = "SELECT * FROM Oldorderfood WHERE orderid = :orderid:";

    $phqlB = "SELECT * FROM Oldorderfood WHERE ordercode = :ordercode:";

    $phqlC = "SELECT * FROM Oldorderfood WHERE userid = :userid:";

    $orderFoodOne = $app->modelsManager->executeQuery(
        $phqlA,
        [
            'orderid' => $orderid,
        ]
    )->getFirst();

    $orderFoodTwo = $app->modelsManager->executeQuery(
        $phqlB,
        [
            'ordercode' => $orderid,
        ]
    );

    $orderFoodThree = $app->modelsManager->executeQuery(
        $phqlC,
        [
            'userid' => $orderid,
        ]
    );

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if($orderFoodOne === false){
        if(sizeof($orderFoodTwo) === 0){
            if(sizeof($orderFoodThree) === 0) {
                $response->setStatusCode(406, 'Not Acceptable');
                $response->setJsonContent([
                    'status' => 'error',
                    'messages' => "old food order with parameter : " . $orderid . " doesn't exist",
                    'data' => array(),
                ]);
            }else {
                foreach ($orderFoodThree as $oft) {
                    $data[] = [
                        'orderid'				    =>	$oft->orderid,
                        'orderdate'		            =>	$oft->orderdate,
                        'ordertime'			        =>	$oft->ordertime,
                        'expectedtime'	            =>	$oft->expectedtime,
                        'afterminutes'	            =>	$oft->afterminutes,
                        'status'			        =>	$oft->status,
                        'restauname'		        =>	$oft->restauname,
                        'foodid'		            =>	$oft->foodid,
                        'foodname'		            =>	$oft->foodname,
                        'foodprice'		            =>	$oft->foodprice,
                        'foodqty'		            =>	$oft->foodqty,
                        'userid'		            =>	$oft->userid,
                        'orderyear'		            =>	$oft->orderyear,
                        'ordermonth'		        =>	$oft->ordermonth,
                        'orderday'		            =>	$oft->orderday,
                        'ordercode'		            =>	$oft->ordercode,
                    ];
                }
                $response->setJsonContent([
                    'status' => 'success',
                    'messages' => "old food order with parameter : ".$orderid." exists",
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
        }else{
            foreach ($orderFoodTwo as $oft) {
                $data[] = [
                    'orderid'				    =>	$oft->orderid,
                    'orderdate'		            =>	$oft->orderdate,
                    'ordertime'			        =>	$oft->ordertime,
                    'expectedtime'	            =>	$oft->expectedtime,
                    'afterminutes'	            =>	$oft->afterminutes,
                    'status'			        =>	$oft->status,
                    'restauname'		        =>	$oft->restauname,
                    'foodid'		            =>	$oft->foodid,
                    'foodname'		            =>	$oft->foodname,
                    'foodprice'		            =>	$oft->foodprice,
                    'foodqty'		            =>	$oft->foodqty,
                    'userid'		            =>	$oft->userid,
                    'orderyear'		            =>	$oft->orderyear,
                    'ordermonth'		        =>	$oft->ordermonth,
                    'orderday'		            =>	$oft->orderday,
                    'ordercode'		            =>	$oft->ordercode,
                ];
            }
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "old food order with parameter : ".$orderid." exists",
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
    }else{
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "old food order with parameter : ".$orderid." exists",
            'data' => [
                'orderid'				    =>	$orderFoodOne->orderid,
                'orderdate'		            =>	$orderFoodOne->orderdate,
                'ordertime'			        =>	$orderFoodOne->ordertime,
                'expectedtime'	            =>	$orderFoodOne->expectedtime,
                'afterminutes'	            =>	$orderFoodOne->afterminutes,
                'status'			        =>	$orderFoodOne->status,
                'restauname'		        =>	$orderFoodOne->restauname,
                'foodid'		            =>	$orderFoodOne->foodid,
                'foodname'		            =>	$orderFoodOne->foodname,
                'foodprice'		            =>	$orderFoodOne->foodprice,
                'foodqty'		            =>	$orderFoodOne->foodqty,
                'userid'		            =>	$orderFoodOne->userid,
                'orderyear'		            =>	$orderFoodOne->orderyear,
                'ordermonth'		        =>	$orderFoodOne->ordermonth,
                'orderday'		            =>	$orderFoodOne->orderday,
                'ordercode'		            =>	$orderFoodOne->ordercode,
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
// -------------------------- POST AN OLD FOOD ORDER --------------------------
$app->post('/api/v1/oldorderfoods', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $orderFood = $app->request->getJsonRawBody();

    $phqlCheckOrderId = 'SELECT orderid FROM Oldorderfood WHERE orderid = :orderid:';

    $orderFoodCheckId = $app->modelsManager->executeQuery(
        $phqlCheckOrderId,
        [
            'orderid' => $orderFood->orderid,
        ]
    )->getFirst();

    if((is_object($orderFoodCheckId)) and ($orderFoodCheckId->orderid === $orderFood->orderid)){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "old food order can not be created",
            'orderid' => "orderid must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Oldorderfood (orderid, orderdate, ordertime, expectedtime, afterminutes, status, restauname, foodid, 
                                           foodname, foodprice, foodqty, userid, orderyear, ordermonth, orderday, ordercode) 
                  VALUES(:orderid:, :orderdate:, :ordertime:, :expectedtime:, :afterminutes:, :status:, :restauname:, :foodid:, 
                         :foodname:, :foodprice:, :foodqty:, :userid:, :orderyear:, :ordermonth:, :orderday:, :ordercode:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'orderid'				    =>	$orderFood->orderid,
                'orderdate'		            =>	$orderFood->orderdate,
                'ordertime'			        =>	$orderFood->ordertime,
                'expectedtime'	            =>	$orderFood->expectedtime,
                'afterminutes'	            =>	$orderFood->afterminutes,
                'status'			        =>	$orderFood->status,
                'restauname'		        =>	$orderFood->restauname,
                'foodid'		            =>	$orderFood->foodid,
                'foodname'		            =>	$orderFood->foodname,
                'foodprice'		            =>	$orderFood->foodprice,
                'foodqty'		            =>	$orderFood->foodqty,
                'userid'		            =>	$orderFood->userid,
                'orderyear'		            =>	$orderFood->orderyear,
                'ordermonth'		        =>	$orderFood->ordermonth,
                'orderday'		            =>	$orderFood->orderday,
                'ordercode'		            =>	$orderFood->ordercode,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "old food order created successfully",
                'data' => $orderFood,
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
// -------------------------- UPDATE AN OLD FOOD ORDER --------------------------
$app->put('/api/v1/oldorderfoods/{orderid}', function ($orderid) use ($app) {
    // first
    $orderFood = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Oldorderfood WHERE orderid = :orderid:";

    $orderCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'orderid' => $orderid
        ]
    )->getFirst();

    if($orderCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "old food order with orderid : ".$orderid." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Oldorderfood SET orderdate = :orderdate:,  ordertime = :ordertime:, expectedtime = :expectedtime:, afterminutes = :afterminutes:, status = :status:, 
                                         restauname = :restauname:, foodid = :foodid:, foodname = :foodname:, foodprice = :foodprice:, foodqty = :foodqty:, userid = :userid:, 
                                         orderyear = :orderyear:, ordermonth = :ordermonth:, orderday = :orderday:, ordercode = :ordercode: 
                  WHERE orderid = :orderid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'orderid'				    =>	$orderid,
                'orderdate'		            =>	$orderFood->orderdate,
                'ordertime'			        =>	$orderFood->ordertime,
                'expectedtime'	            =>	$orderFood->expectedtime,
                'afterminutes'	            =>	$orderFood->afterminutes,
                'status'			        =>	$orderFood->status,
                'restauname'		        =>	$orderFood->restauname,
                'foodid'		            =>	$orderFood->foodid,
                'foodname'		            =>	$orderFood->foodname,
                'foodprice'		            =>	$orderFood->foodprice,
                'foodqty'		            =>	$orderFood->foodqty,
                'userid'		            =>	$orderFood->userid,
                'orderyear'		            =>	$orderFood->orderyear,
                'ordermonth'		        =>	$orderFood->ordermonth,
                'orderday'		            =>	$orderFood->orderday,
                'ordercode'		            =>	$orderFood->ordercode,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(204, 'No Content');
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
// -------------------------- DELETE AN OLD FOOD ORDER --------------------------
$app->delete('/api/v1/oldorderfoods/{orderid}', function ($orderid) use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    //
    $phqlCheck = "SELECT * FROM Oldorderfood WHERE orderid = :orderid:";

    $orderDrinkCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'orderid' => $orderid
        ]
    )->getFirst();

    if($orderDrinkCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "old food order with orderid : ".$orderid." can not be deleted because it doesn't exist",
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
        $phql = 'DELETE FROM Oldorderfood WHERE orderid = :orderid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'orderid'   =>	$orderid,
            ]
        );

        // Check if the deletion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(202, 'Accepted');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "old food order with orderid : ".$orderid." has been deleted successfully",
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

/*
***************************** CRUD OPERATIONS OF "oldordersummary" TABLE *****************************
 */

// -------------------------- GET ALL OLD ORDERS SUMMARY --------------------------
$app->get('/api/v1/oldordersummaries', function () use ($app) {
    // first
    $phql = "SELECT * FROM Oldordersummary ORDER BY id";

    $oldordersummary = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($oldordersummary) !== 0){
        foreach($oldordersummary as $oldordsum) {
            $data[] = [
                'id'				    =>	$oldordsum->id,
                'ordercode'		        =>	$oldordsum->ordercode,
                'userid'		        =>	$oldordsum->userid,
                'restauname'			=>	$oldordsum->restauname,
                'orderdate'	            =>	$oldordsum->orderdate,
                'ordertime'	            =>	$oldordsum->ordertime,
                'status'			    =>	$oldordsum->status,
                'totalprice'		    =>	$oldordsum->totalprice,
                'totalqty'			    =>	$oldordsum->totalqty,
                'year'	                =>	$oldordsum->year,
                'month'	                =>	$oldordsum->month,
                'day'		            =>	$oldordsum->day,
                'orderrating'		    =>	$oldordsum->orderrating,
                'otherinfo'		        =>	$oldordsum->otherinfo,
                'reasoncanceled'		=>	$oldordsum->reasoncanceled,
                'reasondeleted'		    =>	$oldordsum->reasondeleted,
                'ordernotification'		=>	$oldordsum->ordernotification,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'old orders summary exist',
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
            'messages' => 'old orders summary don\'t exist',
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
// -------------------------- GET ALL OLD ORDERS SUMMARY OF A USER --------------------------
$app->get('/api/v1/user/oldordersummaries/{userid}', function ($userid) use ($app) {
    // first
    $phql = "SELECT * FROM Oldordersummary WHERE userid = :userid: ORDER BY id";

    $oldordersummary = $app->modelsManager->executeQuery(
        $phql,
        [
            'userid' => $userid,
        ]
    );

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($oldordersummary) !== 0){
        foreach($oldordersummary as $oldordsum) {
            $data[] = [
                'id'				    =>	$oldordsum->id,
                'ordercode'		        =>	$oldordsum->ordercode,
                'userid'		        =>	$oldordsum->userid,
                'restauname'			=>	$oldordsum->restauname,
                'orderdate'	            =>	$oldordsum->orderdate,
                'ordertime'	            =>	$oldordsum->ordertime,
                'status'			    =>	$oldordsum->status,
                'totalprice'		    =>	$oldordsum->totalprice,
                'totalqty'			    =>	$oldordsum->totalqty,
                'year'	                =>	$oldordsum->year,
                'month'	                =>	$oldordsum->month,
                'day'		            =>	$oldordsum->day,
                'orderrating'		    =>	$oldordsum->orderrating,
                'otherinfo'		        =>	$oldordsum->otherinfo,
                'reasoncanceled'		=>	$oldordsum->reasoncanceled,
                'reasondeleted'		    =>	$oldordsum->reasondeleted,
                'ordernotification'		=>	$oldordsum->ordernotification,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "old orders summary of user with userid = $userid exist",
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
            'messages' => "old orders summary of user with userid = $userid don't exist",
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
// -------------------------- GET AN OLD ORDER SUMMARY --------------------------
$app->get('/api/v1/oldordersummaries/{id}', function ($id) use ($app) {
    // first
    $phql = "SELECT * FROM Oldordersummary WHERE id = :id:";

    $oldordsum = $app->modelsManager->executeQuery(
        $phql,
        [
            'id' => $id
        ]
    )->getFirst();

    $response = new Response();

    // second
    $data = [];

    if($oldordsum === false){
        $response->setHeader('Content-Type', 'application/json');
        $response->setStatusCode(200, 'OK');
        $response->setJsonContent([
            'status' => 'failed',
            'messages' => "old order summary with id : ".$id." doesn't exist",
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
        $response->setHeader('Content-Type', 'application/json');
        $response->setStatusCode(200, 'OK');
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "old order summary with id : ".$id." exists",
            'data' => [
                'id'				    =>	$oldordsum->id,
                'ordercode'		        =>	$oldordsum->ordercode,
                'userid'		        =>	$oldordsum->userid,
                'restauname'			=>	$oldordsum->restauname,
                'orderdate'	            =>	$oldordsum->orderdate,
                'ordertime'	            =>	$oldordsum->ordertime,
                'status'			    =>	$oldordsum->status,
                'totalprice'		    =>	$oldordsum->totalprice,
                'totalqty'			    =>	$oldordsum->totalqty,
                'year'	                =>	$oldordsum->year,
                'month'	                =>	$oldordsum->month,
                'day'		            =>	$oldordsum->day,
                'orderrating'		    =>	$oldordsum->orderrating,
                'otherinfo'		        =>	$oldordsum->otherinfo,
                'reasoncanceled'		=>	$oldordsum->reasoncanceled,
                'reasondeleted'		    =>	$oldordsum->reasondeleted,
                'ordernotification'		=>	$oldordsum->ordernotification,
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
// -------------------------- POST AN OLD ORDER SUMMARY --------------------------
$app->post('/api/v1/oldordersummaries', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $oldordsum = $app->request->getJsonRawBody();

    $phqlCheckId = 'SELECT id FROM Oldordersummary WHERE id = :id:';

    $oldrderCheckId = $app->modelsManager->executeQuery(
        $phqlCheckId,
        [
            'id' => $oldordsum->id,
        ]
    )->getFirst();

    if((is_object($oldrderCheckId)) and ($oldrderCheckId->id === $oldordsum->id)) {
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "old order summary can not be created",
            'id' => "id must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Oldordersummary (id, ordercode, userid, restauname, orderdate, ordertime, status, totalprice, totalqty, year, 
                                          month, day, orderrating, otherinfo, reasoncanceled, reasondeleted, ordernotification) 
                  VALUES(:id:, :ordercode:, :userid:, :restauname:, :orderdate:, :ordertime:, :status:, :totalprice:, :totalqty:, :year:, 
                         :month:, :day:, :orderrating:, :otherinfo:, :reasoncanceled:, :reasondeleted:, :ordernotification:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				    =>	$oldordsum->id,
                'ordercode'		        =>	$oldordsum->ordercode,
                'userid'		        =>	$oldordsum->userid,
                'restauname'			=>	$oldordsum->restauname,
                'orderdate'	            =>	$oldordsum->orderdate,
                'ordertime'	            =>	$oldordsum->ordertime,
                'status'			    =>	$oldordsum->status,
                'totalprice'		    =>	$oldordsum->totalprice,
                'totalqty'			    =>	$oldordsum->totalqty,
                'year'	                =>	$oldordsum->year,
                'month'	                =>	$oldordsum->month,
                'day'		            =>	$oldordsum->day,
                'orderrating'		    =>	$oldordsum->orderrating,
                'otherinfo'		        =>	$oldordsum->otherinfo,
                'reasoncanceled'		=>	$oldordsum->reasoncanceled,
                'reasondeleted'		    =>	$oldordsum->reasondeleted,
                'ordernotification'		=>	$oldordsum->ordernotification,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "old order summary created successfully",
                'data' => $oldordsum,
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
// -------------------------- UPDATE AN OLD ORDER SUMMARY --------------------------
$app->put('/api/v1/oldordersummaries/{id}', function ($id) use ($app) {
    // first
    $oldordsum = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Oldordersummary WHERE id = :id:";

    $oldordersumCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'id' => $id
        ]
    )->getFirst();

    if($oldordersumCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "old order summary with id : ".$id." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Oldordersummary SET ordercode = :ordercode:, userid = :userid:, restauname = :restauname:, orderdate = :orderdate:, ordertime = :ordertime:, status = :status:, 
                                            totalprice = :totalprice:, totalqty = :totalqty:, year = :year:, month = :month:, day = :day:, orderrating = :orderrating:, 
                                            otherinfo = :otherinfo:, reasoncanceled = :reasoncanceled:, reasondeleted = :reasondeleted:, ordernotification = :ordernotification:  
                  WHERE id = :id:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				    =>	$id,
                'ordercode'		        =>	$oldordsum->ordercode,
                'userid'		        =>	$oldordsum->userid,
                'restauname'			=>	$oldordsum->restauname,
                'orderdate'	            =>	$oldordsum->orderdate,
                'ordertime'	            =>	$oldordsum->ordertime,
                'status'			    =>	$oldordsum->status,
                'totalprice'		    =>	$oldordsum->totalprice,
                'totalqty'			    =>	$oldordsum->totalqty,
                'year'	                =>	$oldordsum->year,
                'month'	                =>	$oldordsum->month,
                'day'		            =>	$oldordsum->day,
                'orderrating'		    =>	$oldordsum->orderrating,
                'otherinfo'		        =>	$oldordsum->otherinfo,
                'reasoncanceled'		=>	$oldordsum->reasoncanceled,
                'reasondeleted'		    =>	$oldordsum->reasondeleted,
                'ordernotification'		=>	$oldordsum->ordernotification,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(204, 'No Content');
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
// -------------------------- DELETE AN OLD ORDER SUMMARY --------------------------
$app->delete('/api/v1/oldordersummaries/{id}', function ($id) use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Oldordersummary WHERE id = :id:";

    $oldordersumCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'id' => $id
        ]
    )->getFirst();

    if($oldordersumCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "old order summary with id : ".$id." can not be deleted because it doesn't exist",
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
        $phql = 'DELETE FROM Oldordersummary WHERE id = :id:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				    =>	$id,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(202, 'Accepted');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "old order summary with id : ".$id." has been deleted successfully",
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

/*
***************************** CRUD OPERATIONS OF "orderdrink" TABLE *****************************
 */

// -------------------------- GET ALL DRINK ORDERS --------------------------
$app->get('/api/v1/orderdrinks', function () use ($app) {
    // first
    $phql = "SELECT * FROM Orderdrink ORDER BY id";

    $orderdrinks = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if(sizeof($orderdrinks) !== 0){
        foreach($orderdrinks as $od) {
            $data[] = [
                'id'				        =>	$od->id,
                'orderid'				    =>	$od->orderid,
                'ordercode'		            =>	$od->ordercode,
                'drinkid'		            =>	$od->drinkid,
                'drinkname'		            =>	$od->drinkname,
                'drinkprice'		        =>	$od->drinkprice,
                'drinkqty'		            =>	$od->drinkqty,
                'orderdate'		            =>	$od->orderdate,
                'ordertime'			        =>	$od->ordertime,
                'expectedtime'	            =>	$od->expectedtime,
                'afterminutes'	            =>	$od->afterminutes,
                'status'			        =>	$od->status,
                'userid'		            =>	$od->userid,
                'orderyear'		            =>	$od->orderyear,
                'ordermonth'		        =>	$od->ordermonth,
                'orderday'		            =>	$od->orderday,
                'restauname'		        =>	$od->restauname,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'drink orders exist',
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
            'messages' => 'drink orders don\'t exist',
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
// -------------------------- GET ALL DRINK ORDERS OF A USER --------------------------
$app->get('/api/v1/user/orderdrinks/{userid}', function ($userid) use ($app) {
    // first
    $phql = "SELECT * FROM Orderdrink WHERE userid = :userid: ORDER BY id";

    $orderdrinks = $app->modelsManager->executeQuery(
        $phql,
        [
            'userid' => $userid,
        ]
    );

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if(sizeof($orderdrinks) !== 0){
        foreach($orderdrinks as $od) {
            $data[] = [
                'id'				        =>	$od->id,
                'orderid'				    =>	$od->orderid,
                'ordercode'		            =>	$od->ordercode,
                'drinkid'		            =>	$od->drinkid,
                'drinkname'		            =>	$od->drinkname,
                'drinkprice'		        =>	$od->drinkprice,
                'drinkqty'		            =>	$od->drinkqty,
                'orderdate'		            =>	$od->orderdate,
                'ordertime'			        =>	$od->ordertime,
                'expectedtime'	            =>	$od->expectedtime,
                'afterminutes'	            =>	$od->afterminutes,
                'status'			        =>	$od->status,
                'userid'		            =>	$od->userid,
                'orderyear'		            =>	$od->orderyear,
                'ordermonth'		        =>	$od->ordermonth,
                'orderday'		            =>	$od->orderday,
                'restauname'		        =>	$od->restauname,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "drink orders of user with userid = $userid exist",
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
            'messages' => "drink orders of user with userid = $userid don't exist",
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
// -------------------------- GET A DRINK ORDER --------------------------
$app->get('/api/v1/orderdrinks/{id}', function ($id) use ($app) {
    // first
    $phqlA = "SELECT * FROM Orderdrink WHERE id = :id:";

    $phqlB = "SELECT * FROM Orderdrink WHERE orderid = :orderid:";

    $phqlC = "SELECT * FROM Orderdrink WHERE ordercode = :ordercode:";

    $phqlD = "SELECT * FROM Orderdrink WHERE userid = :userid:";

    $orderDrinkOne = $app->modelsManager->executeQuery(
        $phqlA,
        [
            'id' => $id,
        ]
    )->getFirst();

    $orderDrinkTwo = $app->modelsManager->executeQuery(
        $phqlB,
        [
            'orderid' => $id,
        ]
    );

    $orderDrinkThree = $app->modelsManager->executeQuery(
        $phqlC,
        [
            'ordercode' => $id,
        ]
    );

    $orderFoodFour = $app->modelsManager->executeQuery(
        $phqlD,
        [
            'userid' => $id,
        ]
    );

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if($orderDrinkOne === false){
        if(sizeof($orderDrinkTwo) === 0){
            if(sizeof($orderDrinkThree) === 0){
                if(sizeof($orderFoodFour) === 0){
                    $response->setStatusCode(406, 'Not Acceptable');
                    $response->setJsonContent([
                        'status' => 'error',
                        'messages' => "drink order with parameter : ".$id." doesn't exist",
                        'data' => array(),
                    ]);
                }else {
                    foreach ($orderFoodFour as $odf) {
                        $data[] = [
                            'id'				        =>	$odf->id,
                            'orderid'				    =>	$odf->orderid,
                            'ordercode'		            =>	$odf->ordercode,
                            'drinkid'		            =>	$odf->drinkid,
                            'drinkname'		            =>	$odf->drinkname,
                            'drinkprice'		        =>	$odf->drinkprice,
                            'drinkqty'		            =>	$odf->drinkqty,
                            'orderdate'		            =>	$odf->orderdate,
                            'ordertime'			        =>	$odf->ordertime,
                            'expectedtime'	            =>	$odf->expectedtime,
                            'afterminutes'	            =>	$odf->afterminutes,
                            'status'			        =>	$odf->status,
                            'userid'		            =>	$odf->userid,
                            'orderyear'		            =>	$odf->orderyear,
                            'ordermonth'		        =>	$odf->ordermonth,
                            'orderday'		            =>	$odf->orderday,
                            'restauname'		        =>	$odf->restauname,
                        ];
                    }
                    $response->setJsonContent([
                        'status' => 'success',
                        'messages' => "drink order with parameter : ".$id." exists",
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
            }else{
                foreach ($orderDrinkThree as $odt) {
                    $data[] = [
                        'id'				        =>	$odt->id,
                        'orderid'				    =>	$odt->orderid,
                        'ordercode'		            =>	$odt->ordercode,
                        'drinkid'		            =>	$odt->drinkid,
                        'drinkname'		            =>	$odt->drinkname,
                        'drinkprice'		        =>	$odt->drinkprice,
                        'drinkqty'		            =>	$odt->drinkqty,
                        'orderdate'		            =>	$odt->orderdate,
                        'ordertime'			        =>	$odt->ordertime,
                        'expectedtime'	            =>	$odt->expectedtime,
                        'afterminutes'	            =>	$odt->afterminutes,
                        'status'			        =>	$odt->status,
                        'userid'		            =>	$odt->userid,
                        'orderyear'		            =>	$odt->orderyear,
                        'ordermonth'		        =>	$odt->ordermonth,
                        'orderday'		            =>	$odt->orderday,
                        'restauname'		        =>	$odt->restauname,
                    ];
                }
                $response->setJsonContent([
                    'status' => 'success',
                    'messages' => "drink order with parameter : ".$id." exists",
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
        }else{
            foreach ($orderDrinkTwo as $odt) {
                $data[] = [
                    'id'				        =>	$odt->id,
                    'orderid'				    =>	$odt->orderid,
                    'ordercode'		            =>	$odt->ordercode,
                    'drinkid'		            =>	$odt->drinkid,
                    'drinkname'		            =>	$odt->drinkname,
                    'drinkprice'		        =>	$odt->drinkprice,
                    'drinkqty'		            =>	$odt->drinkqty,
                    'orderdate'		            =>	$odt->orderdate,
                    'ordertime'			        =>	$odt->ordertime,
                    'expectedtime'	            =>	$odt->expectedtime,
                    'afterminutes'	            =>	$odt->afterminutes,
                    'status'			        =>	$odt->status,
                    'userid'		            =>	$odt->userid,
                    'orderyear'		            =>	$odt->orderyear,
                    'ordermonth'		        =>	$odt->ordermonth,
                    'orderday'		            =>	$odt->orderday,
                    'restauname'		        =>	$odt->restauname,
                ];
            }
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "drink order with parameter : ".$id." exists",
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
    }else{
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "drink order with parameter : ".$id." exists",
            'data' => [
                'id'				        =>	$orderDrinkOne->id,
                'orderid'				    =>	$orderDrinkOne->orderid,
                'ordercode'		            =>	$orderDrinkOne->ordercode,
                'drinkid'		            =>	$orderDrinkOne->drinkid,
                'drinkname'		            =>	$orderDrinkOne->drinkname,
                'drinkprice'		        =>	$orderDrinkOne->drinkprice,
                'drinkqty'		            =>	$orderDrinkOne->drinkqty,
                'orderdate'		            =>	$orderDrinkOne->orderdate,
                'ordertime'			        =>	$orderDrinkOne->ordertime,
                'expectedtime'	            =>	$orderDrinkOne->expectedtime,
                'afterminutes'	            =>	$orderDrinkOne->afterminutes,
                'status'			        =>	$orderDrinkOne->status,
                'userid'		            =>	$orderDrinkOne->userid,
                'orderyear'		            =>	$orderDrinkOne->orderyear,
                'ordermonth'		        =>	$orderDrinkOne->ordermonth,
                'orderday'		            =>	$orderDrinkOne->orderday,
                'restauname'		        =>	$orderDrinkOne->restauname,
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
// -------------------------- POST A DRINK ORDER --------------------------
$app->post('/api/v1/orderdrinks', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $orderDrink = $app->request->getJsonRawBody();

    $phqlCheckOrderId = 'SELECT id FROM Orderdrink WHERE id = :id:';

    $orderDrinkCheckId = $app->modelsManager->executeQuery(
        $phqlCheckOrderId,
        [
            'id' => $orderDrink->id,
        ]
    )->getFirst();

    if((is_object($orderDrinkCheckId)) and ($orderDrinkCheckId->id === $orderDrink->id)){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "drink order can not be created",
            'id' => "id must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Orderdrink (id, orderid, ordercode, drinkid, drinkname, drinkprice, drinkqty, orderdate, ordertime, 
                                         expectedtime, afterminutes, status, userid, orderyear, ordermonth, orderday, restauname) 
                  VALUES(:id:, :orderid:, :ordercode:, :drinkid:, :drinkname:, :drinkprice:, :drinkqty:, :orderdate:, :ordertime:, 
                         :expectedtime:, :afterminutes:, :status:, :userid:, :orderyear:, :ordermonth:, :orderday:, :restauname:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				        =>	$orderDrink->id,
                'orderid'				    =>	$orderDrink->orderid,
                'ordercode'		            =>	$orderDrink->ordercode,
                'drinkid'		            =>	$orderDrink->drinkid,
                'drinkname'		            =>	$orderDrink->drinkname,
                'drinkprice'		        =>	$orderDrink->drinkprice,
                'drinkqty'		            =>	$orderDrink->drinkqty,
                'orderdate'		            =>	$orderDrink->orderdate,
                'ordertime'			        =>	$orderDrink->ordertime,
                'expectedtime'	            =>	$orderDrink->expectedtime,
                'afterminutes'	            =>	$orderDrink->afterminutes,
                'status'			        =>	$orderDrink->status,
                'userid'		            =>	$orderDrink->userid,
                'orderyear'		            =>	$orderDrink->orderyear,
                'ordermonth'		        =>	$orderDrink->ordermonth,
                'orderday'		            =>	$orderDrink->orderday,
                'restauname'		        =>	$orderDrink->restauname,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "drink order created successfully",
                'data' => $orderDrink,
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
// -------------------------- UPDATE A DRINK ORDER --------------------------
$app->put('/api/v1/orderdrinks/{id}', function ($id) use ($app) {
    // first
    $orderDrink = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Orderdrink WHERE id = :id:";

    $orderCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'id' => $id
        ]
    )->getFirst();

    if($orderCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "drink order with id : ".$id." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Orderdrink SET orderid = :orderid:, ordercode = :ordercode:, drinkid = :drinkid:, drinkname = :drinkname:, 
                                       drinkprice = :drinkprice:, drinkqty = :drinkqty:, orderdate = :orderdate:, ordertime = :ordertime:, 
                                       expectedtime = :expectedtime:, afterminutes = :afterminutes:, status = :status:, userid = :userid:, 
                                       orderyear = :orderyear:, ordermonth = :ordermonth:, orderday = :orderday:, restauname = :restauname: 
                  WHERE id = :id:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				        =>	$id,
                'orderid'				    =>	$orderDrink->orderid,
                'ordercode'		            =>	$orderDrink->ordercode,
                'drinkid'		            =>	$orderDrink->drinkid,
                'drinkname'		            =>	$orderDrink->drinkname,
                'drinkprice'		        =>	$orderDrink->drinkprice,
                'drinkqty'		            =>	$orderDrink->drinkqty,
                'orderdate'		            =>	$orderDrink->orderdate,
                'ordertime'			        =>	$orderDrink->ordertime,
                'expectedtime'	            =>	$orderDrink->expectedtime,
                'afterminutes'	            =>	$orderDrink->afterminutes,
                'status'			        =>	$orderDrink->status,
                'userid'		            =>	$orderDrink->userid,
                'orderyear'		            =>	$orderDrink->orderyear,
                'ordermonth'		        =>	$orderDrink->ordermonth,
                'orderday'		            =>	$orderDrink->orderday,
                'restauname'		        =>	$orderDrink->restauname,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(204, 'No Content');
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
// -------------------------- DELETE A DRINK ORDER --------------------------
$app->delete('/api/v1/orderdrinks/{id}', function ($id) use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    //
    $phqlCheck = "SELECT * FROM Orderdrink WHERE id = :id:";

    $orderDrinkCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'id' => $id
        ]
    )->getFirst();

    if($orderDrinkCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "drink order with id : ".$id." can not be deleted because it doesn't exist",
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
        $phql = 'DELETE FROM Orderdrink WHERE id = :id:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				    =>	$id,
            ]
        );


        // Check if the deletion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(202, 'Accepted');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "drink order with id : ".$id." has been deleted successfully",
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

/*
***************************** CRUD OPERATIONS OF "orderfood" TABLE *****************************
 */

// -------------------------- GET ALL FOOD ORDERS --------------------------
$app->get('/api/v1/orderfoods', function () use ($app) {
    // first
    $phql = "SELECT * FROM Orderfood ORDER BY orderid";

    $oldorderfoods = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if(sizeof($oldorderfoods) !== 0){
        foreach($oldorderfoods as $oof) {
            $data[] = [
                'orderid'				    =>	$oof->orderid,
                'orderdate'		            =>	$oof->orderdate,
                'ordertime'			        =>	$oof->ordertime,
                'expectedtime'	            =>	$oof->expectedtime,
                'afterminutes'	            =>	$oof->afterminutes,
                'status'			        =>	$oof->status,
                'restauname'		        =>	$oof->restauname,
                'foodid'		            =>	$oof->foodid,
                'foodname'		            =>	$oof->foodname,
                'foodprice'		            =>	$oof->foodprice,
                'foodqty'		            =>	$oof->foodqty,
                'userid'		            =>	$oof->userid,
                'orderyear'		            =>	$oof->orderyear,
                'ordermonth'		        =>	$oof->ordermonth,
                'orderday'		            =>	$oof->orderday,
                'ordercode'		            =>	$oof->ordercode,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'food orders exist',
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
            'messages' => 'food orders don\'t exist',
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
// -------------------------- GET ALL FOOD ORDERS OF A USER --------------------------
$app->get('/api/v1/user/orderfoods/{userid}', function ($userid) use ($app) {
    // first
    $phql = "SELECT * FROM Orderfood WHERE userid = :userid: ORDER BY orderid";

    $oldorderfoods = $app->modelsManager->executeQuery(
        $phql,
        [
            'userid' => $userid,
        ]
    );

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if(sizeof($oldorderfoods) !== 0){
        foreach($oldorderfoods as $oof) {
            $data[] = [
                'orderid'				    =>	$oof->orderid,
                'orderdate'		            =>	$oof->orderdate,
                'ordertime'			        =>	$oof->ordertime,
                'expectedtime'	            =>	$oof->expectedtime,
                'afterminutes'	            =>	$oof->afterminutes,
                'status'			        =>	$oof->status,
                'restauname'		        =>	$oof->restauname,
                'foodid'		            =>	$oof->foodid,
                'foodname'		            =>	$oof->foodname,
                'foodprice'		            =>	$oof->foodprice,
                'foodqty'		            =>	$oof->foodqty,
                'userid'		            =>	$oof->userid,
                'orderyear'		            =>	$oof->orderyear,
                'ordermonth'		        =>	$oof->ordermonth,
                'orderday'		            =>	$oof->orderday,
                'ordercode'		            =>	$oof->ordercode,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "food orders of user with userid = $userid exist",
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
            'messages' => "food orders of user with userid = $userid don't exist",
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

// -------------------------- GET A FOOD ORDER --------------------------
$app->get('/api/v1/orderfoods/{orderid}', function ($orderid) use ($app) {
    // first
    $phqlA = "SELECT * FROM Orderfood WHERE orderid = :orderid:";

    $phqlB = "SELECT * FROM Orderfood WHERE ordercode = :ordercode:";

    $phqlC = "SELECT * FROM Orderfood WHERE userid = :userid:";

    $orderFoodOne = $app->modelsManager->executeQuery(
        $phqlA,
        [
            'orderid' => $orderid,
        ]
    )->getFirst();

    $orderFoodTwo = $app->modelsManager->executeQuery(
        $phqlB,
        [
            'ordercode' => $orderid,
        ]
    );

    $orderFoodThree = $app->modelsManager->executeQuery(
        $phqlC,
        [
            'userid' => $orderid,
        ]
    );

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    // second
    $data = [];

    if($orderFoodOne === false){
        if(sizeof($orderFoodTwo) === 0){
            if(sizeof($orderFoodThree) === 0) {
                $response->setStatusCode(406, 'Not Acceptable');
                $response->setJsonContent([
                    'status' => 'error',
                    'messages' => "food order with parameter : " . $orderid . " doesn't exist",
                    'data' => array(),
                ]);
            }else {
                foreach ($orderFoodThree as $oft) {
                    $data[] = [
                        'orderid'				    =>	$oft->orderid,
                        'orderdate'		            =>	$oft->orderdate,
                        'ordertime'			        =>	$oft->ordertime,
                        'expectedtime'	            =>	$oft->expectedtime,
                        'afterminutes'	            =>	$oft->afterminutes,
                        'status'			        =>	$oft->status,
                        'restauname'		        =>	$oft->restauname,
                        'foodid'		            =>	$oft->foodid,
                        'foodname'		            =>	$oft->foodname,
                        'foodprice'		            =>	$oft->foodprice,
                        'foodqty'		            =>	$oft->foodqty,
                        'userid'		            =>	$oft->userid,
                        'orderyear'		            =>	$oft->orderyear,
                        'ordermonth'		        =>	$oft->ordermonth,
                        'orderday'		            =>	$oft->orderday,
                        'ordercode'		            =>	$oft->ordercode,
                    ];
                }
                $response->setJsonContent([
                    'status' => 'success',
                    'messages' => "food order with parameter : ".$orderid." exists",
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
        }else{
            foreach ($orderFoodTwo as $oft) {
                $data[] = [
                    'orderid'				    =>	$oft->orderid,
                    'orderdate'		            =>	$oft->orderdate,
                    'ordertime'			        =>	$oft->ordertime,
                    'expectedtime'	            =>	$oft->expectedtime,
                    'afterminutes'	            =>	$oft->afterminutes,
                    'status'			        =>	$oft->status,
                    'restauname'		        =>	$oft->restauname,
                    'foodid'		            =>	$oft->foodid,
                    'foodname'		            =>	$oft->foodname,
                    'foodprice'		            =>	$oft->foodprice,
                    'foodqty'		            =>	$oft->foodqty,
                    'userid'		            =>	$oft->userid,
                    'orderyear'		            =>	$oft->orderyear,
                    'ordermonth'		        =>	$oft->ordermonth,
                    'orderday'		            =>	$oft->orderday,
                    'ordercode'		            =>	$oft->ordercode,
                ];
            }
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "food order with parameter : ".$orderid." exists",
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
    }else{
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "food order with parameter : ".$orderid." exists",
            'data' => [
                'orderid'				    =>	$orderFoodOne->orderid,
                'orderdate'		            =>	$orderFoodOne->orderdate,
                'ordertime'			        =>	$orderFoodOne->ordertime,
                'expectedtime'	            =>	$orderFoodOne->expectedtime,
                'afterminutes'	            =>	$orderFoodOne->afterminutes,
                'status'			        =>	$orderFoodOne->status,
                'restauname'		        =>	$orderFoodOne->restauname,
                'foodid'		            =>	$orderFoodOne->foodid,
                'foodname'		            =>	$orderFoodOne->foodname,
                'foodprice'		            =>	$orderFoodOne->foodprice,
                'foodqty'		            =>	$orderFoodOne->foodqty,
                'userid'		            =>	$orderFoodOne->userid,
                'orderyear'		            =>	$orderFoodOne->orderyear,
                'ordermonth'		        =>	$orderFoodOne->ordermonth,
                'orderday'		            =>	$orderFoodOne->orderday,
                'ordercode'		            =>	$orderFoodOne->ordercode,
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
// -------------------------- POST A FOOD ORDER --------------------------
$app->post('/api/v1/orderfoods', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $orderFood = $app->request->getJsonRawBody();

    $phqlCheckOrderId = 'SELECT orderid FROM Orderfood WHERE orderid = :orderid:';

    $orderFoodCheckId = $app->modelsManager->executeQuery(
        $phqlCheckOrderId,
        [
            'orderid' => $orderFood->orderid,
        ]
    )->getFirst();

    if((is_object($orderFoodCheckId)) and ($orderFoodCheckId->orderid === $orderFood->orderid)){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "food order can not be created",
            'orderid' => "orderid must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Orderfood (orderid, orderdate, ordertime, expectedtime, afterminutes, status, restauname, foodid, 
                                           foodname, foodprice, foodqty, userid, orderyear, ordermonth, orderday, ordercode) 
                  VALUES(:orderid:, :orderdate:, :ordertime:, :expectedtime:, :afterminutes:, :status:, :restauname:, :foodid:, 
                         :foodname:, :foodprice:, :foodqty:, :userid:, :orderyear:, :ordermonth:, :orderday:, :ordercode:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'orderid'				    =>	$orderFood->orderid,
                'orderdate'		            =>	$orderFood->orderdate,
                'ordertime'			        =>	$orderFood->ordertime,
                'expectedtime'	            =>	$orderFood->expectedtime,
                'afterminutes'	            =>	$orderFood->afterminutes,
                'status'			        =>	$orderFood->status,
                'restauname'		        =>	$orderFood->restauname,
                'foodid'		            =>	$orderFood->foodid,
                'foodname'		            =>	$orderFood->foodname,
                'foodprice'		            =>	$orderFood->foodprice,
                'foodqty'		            =>	$orderFood->foodqty,
                'userid'		            =>	$orderFood->userid,
                'orderyear'		            =>	$orderFood->orderyear,
                'ordermonth'		        =>	$orderFood->ordermonth,
                'orderday'		            =>	$orderFood->orderday,
                'ordercode'		            =>	$orderFood->ordercode,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "food order created successfully",
                'data' => $orderFood,
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
// -------------------------- UPDATE A FOOD ORDER --------------------------
$app->put('/api/v1/orderfoods/{orderid}', function ($orderid) use ($app) {
    // first
    $orderFood = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Orderfood WHERE orderid = :orderid:";

    $orderCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'orderid' => $orderid
        ]
    )->getFirst();

    if($orderCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "food order with orderid : ".$orderid." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Orderfood SET orderdate = :orderdate:,  ordertime = :ordertime:, expectedtime = :expectedtime:, afterminutes = :afterminutes:, status = :status:, 
                                         restauname = :restauname:, foodid = :foodid:, foodname = :foodname:, foodprice = :foodprice:, foodqty = :foodqty:, userid = :userid:, 
                                         orderyear = :orderyear:, ordermonth = :ordermonth:, orderday = :orderday:, ordercode = :ordercode: 
                  WHERE orderid = :orderid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'orderid'				    =>	$orderid,
                'orderdate'		            =>	$orderFood->orderdate,
                'ordertime'			        =>	$orderFood->ordertime,
                'expectedtime'	            =>	$orderFood->expectedtime,
                'afterminutes'	            =>	$orderFood->afterminutes,
                'status'			        =>	$orderFood->status,
                'restauname'		        =>	$orderFood->restauname,
                'foodid'		            =>	$orderFood->foodid,
                'foodname'		            =>	$orderFood->foodname,
                'foodprice'		            =>	$orderFood->foodprice,
                'foodqty'		            =>	$orderFood->foodqty,
                'userid'		            =>	$orderFood->userid,
                'orderyear'		            =>	$orderFood->orderyear,
                'ordermonth'		        =>	$orderFood->ordermonth,
                'orderday'		            =>	$orderFood->orderday,
                'ordercode'		            =>	$orderFood->ordercode,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(204, 'No Content');
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
// -------------------------- DELETE A FOOD ORDER --------------------------
$app->delete('/api/v1/orderfoods/{orderid}', function ($orderid) use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    //
    $phqlCheck = "SELECT * FROM Orderfood WHERE orderid = :orderid:";

    $orderDrinkCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'orderid' => $orderid
        ]
    )->getFirst();

    if($orderDrinkCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "food order with orderid : ".$orderid." can not be deleted because it doesn't exist",
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
        $phql = 'DELETE FROM Orderfood WHERE orderid = :orderid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'orderid'				    =>	$orderid,
            ]
        );

        // Check if the deletion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(202, 'Accepted');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "food order with orderid : ".$orderid." has been deleted successfully",
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

/*
***************************** CRUD OPERATIONS OF "ordersummary" TABLE *****************************
 */

// -------------------------- GET ALL ORDER SUMMARY --------------------------
$app->get('/api/v1/ordersummaries', function () use ($app) {
    // first
    $phql = "SELECT * FROM Ordersummary ORDER BY id";

    $ordersummary = $app->modelsManager->executeQuery($phql);

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($ordersummary) !== 0){
        foreach($ordersummary as $ordsum) {
            $data[] = [
                'id'				    =>	$ordsum->id,
                'ordercode'		        =>	$ordsum->ordercode,
                'userid'		        =>	$ordsum->userid,
                'restauname'			=>	$ordsum->restauname,
                'orderdate'	            =>	$ordsum->orderdate,
                'ordertime'	            =>	$ordsum->ordertime,
                'status'			    =>	$ordsum->status,
                'totalprice'		    =>	$ordsum->totalprice,
                'totalqty'			    =>	$ordsum->totalqty,
                'year'	                =>	$ordsum->year,
                'month'	                =>	$ordsum->month,
                'day'		            =>	$ordsum->day,
                'orderrating'		    =>	$ordsum->orderrating,
                'otherinfo'		        =>	$ordsum->otherinfo,
                'reasoncanceled'		=>	$ordsum->reasoncanceled,
                'reasondeleted'		    =>	$ordsum->reasondeleted,
                'ordernotification'		=>	$ordsum->ordernotification,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => 'orders summary exist',
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
            'messages' => 'orders summary don\'t exist',
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
// -------------------------- GET ALL ORDER SUMMARY OF A USER --------------------------
$app->get('/api/v1/user/ordersummaries/{userid}', function ($userid) use ($app) {
    // first
    $phql = "SELECT * FROM Ordersummary WHERE userid = :userid: ORDER BY id";

    $ordersummary = $app->modelsManager->executeQuery(
        $phql,
        [
            'userid' => $userid,
        ]
    );

    $response = new Response();

    // second
    $data = [];

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if(sizeof($ordersummary) !== 0){
        foreach($ordersummary as $ordsum) {
            $data[] = [
                'id'				    =>	$ordsum->id,
                'ordercode'		        =>	$ordsum->ordercode,
                'userid'		        =>	$ordsum->userid,
                'restauname'			=>	$ordsum->restauname,
                'orderdate'	            =>	$ordsum->orderdate,
                'ordertime'	            =>	$ordsum->ordertime,
                'status'			    =>	$ordsum->status,
                'totalprice'		    =>	$ordsum->totalprice,
                'totalqty'			    =>	$ordsum->totalqty,
                'year'	                =>	$ordsum->year,
                'month'	                =>	$ordsum->month,
                'day'		            =>	$ordsum->day,
                'orderrating'		    =>	$ordsum->orderrating,
                'otherinfo'		        =>	$ordsum->otherinfo,
                'reasoncanceled'		=>	$ordsum->reasoncanceled,
                'reasondeleted'		    =>	$ordsum->reasondeleted,
                'ordernotification'		=>	$ordsum->ordernotification,
            ];
        }
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "orders summary of user with userid = $userid exist",
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
            'messages' => "orders summary of user with userid = $userid don't exist",
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
// -------------------------- GET AN ORDER SUMMARY --------------------------
$app->get('/api/v1/ordersummaries/{id}', function ($id) use ($app) {
    // first
    $phql = "SELECT * FROM Ordersummary WHERE id = :id:";

    $ordsum = $app->modelsManager->executeQuery(
        $phql,
        [
            'id' => $id
        ]
    )->getFirst();

    $response = new Response();

    // second
    $data = [];

    if($ordsum === false){
        $response->setHeader('Content-Type', 'application/json');
        $response->setStatusCode(200, 'OK');
        $response->setJsonContent([
            'status' => 'failed',
            'messages' => "order summary with id : ".$id." doesn't exist",
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
        $response->setHeader('Content-Type', 'application/json');
        $response->setStatusCode(200, 'OK');
        $response->setJsonContent([
            'status' => 'success',
            'messages' => "order summary with id : ".$id." exists",
            'data' => [
                'id'				    =>	$ordsum->id,
                'ordercode'		        =>	$ordsum->ordercode,
                'userid'		        =>	$ordsum->userid,
                'restauname'			=>	$ordsum->restauname,
                'orderdate'	            =>	$ordsum->orderdate,
                'ordertime'	            =>	$ordsum->ordertime,
                'status'			    =>	$ordsum->status,
                'totalprice'		    =>	$ordsum->totalprice,
                'totalqty'			    =>	$ordsum->totalqty,
                'year'	                =>	$ordsum->year,
                'month'	                =>	$ordsum->month,
                'day'		            =>	$ordsum->day,
                'orderrating'		    =>	$ordsum->orderrating,
                'otherinfo'		        =>	$ordsum->otherinfo,
                'reasoncanceled'		=>	$ordsum->reasoncanceled,
                'reasondeleted'		    =>	$ordsum->reasondeleted,
                'ordernotification'		=>	$ordsum->ordernotification,
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
// -------------------------- POST AN ORDER SUMMARY --------------------------
$app->post('/api/v1/ordersummaries', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $ordsum = $app->request->getJsonRawBody();

    $phqlCheckId = 'SELECT id FROM Ordersummary WHERE id = :id:';

    $orderCheckId = $app->modelsManager->executeQuery(
        $phqlCheckId,
        [
            'id' => $ordsum->id,
        ]
    )->getFirst();

    if((is_object($orderCheckId)) and ($orderCheckId->id === $ordsum->id)) {
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "order summary can not be created",
            'id' => "id must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Ordersummary (id, ordercode, userid, restauname, orderdate, ordertime, status, totalprice, totalqty, year, 
                                   month, day, orderrating, otherinfo, reasoncanceled, reasondeleted, ordernotification) 
                  VALUES(:id:, :ordercode:, :userid:, :restauname:, :orderdate:, :ordertime:, :status:, :totalprice:, :totalqty:, :year:, 
                          :month:, :day:, :orderrating:, :otherinfo:, :reasoncanceled:, :reasondeleted:, :ordernotification:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				    =>	$ordsum->id,
                'ordercode'		        =>	$ordsum->ordercode,
                'userid'		        =>	$ordsum->userid,
                'restauname'			=>	$ordsum->restauname,
                'orderdate'	            =>	$ordsum->orderdate,
                'ordertime'	            =>	$ordsum->ordertime,
                'status'			    =>	$ordsum->status,
                'totalprice'		    =>	$ordsum->totalprice,
                'totalqty'			    =>	$ordsum->totalqty,
                'year'	                =>	$ordsum->year,
                'month'	                =>	$ordsum->month,
                'day'		            =>	$ordsum->day,
                'orderrating'		    =>	$ordsum->orderrating,
                'otherinfo'		        =>	$ordsum->otherinfo,
                'reasoncanceled'		=>	$ordsum->reasoncanceled,
                'reasondeleted'		    =>	$ordsum->reasondeleted,
                'ordernotification'		=>	$ordsum->ordernotification,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "order summary created successfully",
                'data' => $ordsum,
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
// -------------------------- UPDATE AN ORDER SUMMARY --------------------------
$app->put('/api/v1/ordersummaries/{id}', function ($id) use ($app) {
    // first
    $ordsum = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Ordersummary WHERE id = :id:";

    $ordersumCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'id' => $id
        ]
    )->getFirst();

    if($ordersumCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "order summary with id : ".$id." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Ordersummary SET ordercode = :ordercode:, userid = :userid:, restauname = :restauname:, orderdate = :orderdate:, ordertime = :ordertime:, status = :status:, 
                                         totalprice = :totalprice:, totalqty = :totalqty:, year = :year:, month = :month:, day = :day:, orderrating = :orderrating:, 
                                         otherinfo = :otherinfo:, reasoncanceled = :reasoncanceled:, reasondeleted = :reasondeleted:, ordernotification = :ordernotification:  
                  WHERE id = :id:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				    =>	$id,
                'ordercode'		        =>	$ordsum->ordercode,
                'userid'		        =>	$ordsum->userid,
                'restauname'			=>	$ordsum->restauname,
                'orderdate'	            =>	$ordsum->orderdate,
                'ordertime'	            =>	$ordsum->ordertime,
                'status'			    =>	$ordsum->status,
                'totalprice'		    =>	$ordsum->totalprice,
                'totalqty'			    =>	$ordsum->totalqty,
                'year'	                =>	$ordsum->year,
                'month'	                =>	$ordsum->month,
                'day'		            =>	$ordsum->day,
                'orderrating'		    =>	$ordsum->orderrating,
                'otherinfo'		        =>	$ordsum->otherinfo,
                'reasoncanceled'		=>	$ordsum->reasoncanceled,
                'reasondeleted'		    =>	$ordsum->reasondeleted,
                'ordernotification'		=>	$ordsum->ordernotification,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(204, 'No Content');
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
// -------------------------- DELETE AN ORDER SUMMARY --------------------------
$app->delete('/api/v1/ordersummaries/{id}', function ($id) use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Ordersummary WHERE id = :id:";

    $ordersumCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'id' => $id
        ]
    )->getFirst();

    if($ordersumCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "order summary with id : ".$id." can not be deleted because it doesn't exist",
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
        $phql = 'DELETE FROM Ordersummary WHERE id = :id:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				    =>	$id,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(202, 'Accepted');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "order summary with id : ".$id." has been deleted successfully",
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

/*
***************************** CRUD OPERATIONS OF "users" TABLE *****************************
 */

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
// -------------------------- POST A USER --------------------------
$app->post('/api/v1/users', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $user = $app->request->getJsonRawBody();

    $phqlCheckUserId = 'SELECT userid FROM Users WHERE userid = :userid:';

    $userCheckId = $app->modelsManager->executeQuery(
        $phqlCheckUserId,
        [
            'userid' => $user->userid,
        ]
    )->getFirst();

    if((is_object($userCheckId)) and ($userCheckId->userid === $user->userid)){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "user can not be created",
            'userid' => "userid must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Users (userid, fname, lname, email, phonenumber, username, password, status, registrationyear, registrationmonth, 
                                registrationday, datebirth, nationality, gender, description, otherinfo, homeaddress, city, country, photo) 
              VALUES (:userid:, :fname:, :lname:, :email:,  :phonenumber:, :username:, :password:, :status:, :registrationyear:, :registrationmonth:, 
                      :registrationday:, :datebirth:, :nationality:, :gender:, :description:, :otherinfo:, :homeaddress:, :city:, :country:, :photo:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
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
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "user created successfully",
                'data' => $user,
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
// -------------------------- UPDATE A USER --------------------------
$app->put('/api/v1/users/{userid}', function ($userid) use ($app) {
    // first
    $user = $app->request->getJsonRawBody();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Users WHERE userid = :userid:";

    $userCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'userid' => $userid
        ]
    )->getFirst();

    if($userCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "user with userid : ".$userid." can not be updated because it doesn't exist",
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
        $phql = 'UPDATE Users SET fname = :fname:, lname = :lname:, email = :email:, phonenumber = :phonenumber:, username = :username:, 
                                  password = :password:, status = :status:, registrationyear = :registrationyear:, registrationmonth = :registrationmonth:, 
                                  registrationday = :registrationday:, datebirth = :datebirth:, nationality = :nationality:, gender = :gender:, 
                                  description = :description:, otherinfo = :otherinfo:, homeaddress = :homeaddress:, city = :city:, country = :country:, photo = :photo:  
                  WHERE userid = :userid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'userid'				    =>	$userid,
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
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(204, 'No Content');
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
// -------------------------- DELETE A USER --------------------------
$app->delete('/api/v1/users/{userid}', function ($userid) use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    //
    $phqlCheck = "SELECT * FROM Users WHERE userid = :userid:";

    $userCheck = $app->modelsManager->executeQuery(
        $phqlCheck,
        [
            'userid' => $userid
        ]
    )->getFirst();

    if($userCheck === false){
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "user with userid : ".$userid." can not be deleted because it doesn't exist",
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
        $phql = 'DELETE FROM Users WHERE userid = :userid:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'userid'				    =>	$userid,
            ]
        );

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(202, 'Accepted');
            $response->setJsonContent([
                'status' => 'success',
                'messages' => "user with userid : ".$userid." has been deleted successfully",
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

/*
***************************** AUTHENTICATION USER *****************************
 */
$app->post('/api/v1/users/authentication', function () use ($app) {
    // first
    $checkUser = $app->request->getJsonRawBody();

    // first
    $phql = "SELECT * FROM Users WHERE email = :email: AND password = :password:";

    $user = $app->modelsManager->executeQuery(
        $phql,
        [
            'email' => $checkUser->email,
            'password' => $checkUser->password
        ]
    )->getFirst();

    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');
    $response->setStatusCode(200, 'OK');

    if($user === false){
        $response->setJsonContent([
            'status' => 'error',
            'messages' => 'User doesn\'t exist',
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
    }else{
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
    }
    // third
    return $response;
});

/*
***************************** UNKNOWN METHOD AND OTHERS ERRORS *****************************
 */

//
$app->notFound( function () use ($app) {
    $app->response->setHeader('Content-Type', 'application/json');
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    $app->response->setJsonContent([
        'status' => 'Requested resource can not be found'
    ])->send();
});

$app->handle();