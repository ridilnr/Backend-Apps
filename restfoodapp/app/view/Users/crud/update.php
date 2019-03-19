<?php
use Phalcon\Http\Response;
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
                'password'		            =>	$this->security->hash($user->password),
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