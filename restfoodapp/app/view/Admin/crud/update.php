<?php
use Phalcon\Http\Response;
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