<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness  as UniquenessValidator;
use Phalcon\Validation\Validator\Date as DateValidator;

class Admin extends Model
{

    // Columns
    public $idadmin;
    public $fname;
    public $lname;
    public $email;
    public $username;
    public $password;
    public $status;
    public $type;
    public $pswupdatecode;
    public $pswupdatelink;
    public $datecreation;
    public $lastupdatedate;
    public $lastlogindate;
    public $description;
    public $otherinfo;
    public $datebirth;
    public $gender;
    public $phonenumber;

    // Validations
    public function validation(){

        $validator = new Validation();

        /************************************************************************************************************
         *                              CHECK UNIQUENESS OF SOME FIELDS (DUPLICATED VALUES ARE NOT ALLOWED)
         ***********************************************************************************************************/
        /*$validator->add(
            'idadmin',
            new UniquenessValidator([
                'model' => new Admin(),
                'message' => ':field must be unique',
            ])
        );*/

        $validator->add(
            'email',
            new UniquenessValidator([
                'model' => new Admin(),
                'message' => ':field must be unique',
            ])
        );

        $validator->add(
            'username',
            new UniquenessValidator([
                'model' => new Admin(),
                'message' => ':field must be unique',
            ])
        );
        /************************************************************************************************************
         *                              CHECK PRESENCE OF SOME FIELDS (NULL VALUES ARE NOT ACCEPTED)
         ***********************************************************************************************************/
        $validator->add(
            [
                "idadmin",
                "fname",
                "email",
                "username",
                "password",
                "status",
                "type",
                "datecreation",
            ],
            new PresenceOf(
                [
                    "message" => [
                        "idadmin" => ":field is required",
                        "fname" => ":field is required",
                        "email" => ":field is required",
                        "username" => ":field is required",
                        "password" => ":field is required",
                        "status" => ":field is required",
                        "type" => ":field is required",
                        "datecreation" => ":field is required",
                    ],
                ]
            )
        );
        /************************************************************************************************************
         *                              CHECK VALIDITY OF AN E-MAIL ADDRESS
         ***********************************************************************************************************/
        $validator->add(
            "email",
            new EmailValidator(
                [
                    "message" => ":field is not valid",
                ]
            )
        );
        /************************************************************************************************************
         *                              CHECK VALIDITY OF A DATE
         ***********************************************************************************************************/
        $validator->add(
            "datecreation",
            new DateValidator(
                [
                    "format"  => "Y-m-d",
                    "message" => ":field is invalid",
                ]
            )
        );
        return $this->validate($validator);
    }
}