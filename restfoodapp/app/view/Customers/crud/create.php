<?php
use Phalcon\Http\Response;
// -------------------------- POST A CUSTOMER --------------------------
$app->post('/api/v1/customers', function () use ($app) {
    // first
    $response = new Response();

    $response->setHeader('Content-Type', 'application/json');

    $customer = $app->request->getJsonRawBody();

	$customerid = "c".str_replace(["-", ":", " "], "", date("Y-m-d H:i:s"))."".mt_rand(10000, 99999);
	
    $phqlCheckId = 'SELECT id FROM Customers WHERE id = :id:';

    $customerCheckId = $app->modelsManager->executeQuery(
        $phqlCheckId,
        [
            'id' => $customerid,
        ]
    )->getFirst();

    if((is_object($customerCheckId)) and ($customerCheckId->id === $customerid)) {
        $response->setStatusCode(406, 'Not Acceptable');
        $response->setJsonContent([
            'status' => 'error',
            'messages' => "customer can not be created",
            'id' => "id must be unique",
        ]);
    }else{
        $phql = "INSERT INTO Customers (id, userid, fullname, email, phonenumber, city, address, idresto, photo, customerrating,
                                    restorating, restocomments, otherinfo, allownotifications, membershipdate, status) 
             VALUES (:id:, :userid:, :fullname:, :email:, :phonenumber:, :city:, :address:, :idresto:, :photo:, :customerrating:, 
                     :restorating:, :restocomments:, :otherinfo:, :allownotifications:, :membershipdate:, :status:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'				        =>	$customerid,
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
                'membershipdate'			=>	date("Y-m-d"),
				'status'					=>	"active",
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