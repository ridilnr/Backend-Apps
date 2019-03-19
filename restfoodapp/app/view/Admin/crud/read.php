<?php
use Phalcon\Http\Response;
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
            'status' => 'success ->',
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