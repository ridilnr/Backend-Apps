<?php
use Phalcon\Http\Response;
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