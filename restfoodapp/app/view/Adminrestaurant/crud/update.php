<?php
use Phalcon\Http\Response;
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