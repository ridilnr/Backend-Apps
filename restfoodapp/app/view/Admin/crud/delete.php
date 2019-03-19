<?php
use Phalcon\Http\Response;
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