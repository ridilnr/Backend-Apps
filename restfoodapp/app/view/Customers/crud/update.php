<?php
use Phalcon\Http\Response;
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
                                      allownotifications = :allownotifications:, membershipdate = :membershipdate:, status = :status:  
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
				'status'					=>	$customer->status,
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