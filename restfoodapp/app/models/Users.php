<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness  as UniquenessValidator;
use Phalcon\Validation\Validator\Date as DateValidator;

class Users extends Model
{

	// Columns
    public $userid;
    public $fname;
    public $lname;
    public $email1;
    public $phonenumber;
    public $username;
    public $password;
    public $nationality;
    public $description;
    public $otherinfo;
    public $city;
    public $country;
    public $photo;

	// Validations
    public function beforeCreate(){

        $validator = new Validation();

        /************************************************************************************************************
         *                              CHECK UNIQUENESS OF SOME FIELDS (DUPLICATED VALUES ARE NOT ALLOWED)
         ***********************************************************************************************************/

        $validator->add(
            'email',
            new UniquenessValidator([
                'model' => new Users(),
                'message' => ':field must be unique',
            ])
        );

        $validator->add(
            'phonenumber',
            new UniquenessValidator([
                'model' => new Users(),
                'message' => ':field must be unique',
            ])
        );
        
        $validator->add(
            'username',
            new UniquenessValidator([
                'model' => new Users(),
                'message' => ':field must be unique',
            ])
        );
        /************************************************************************************************************
         *                              CHECK PRESENCE OF SOME FIELDS (NULL VALUES ARE NOT ACCEPTED)
         ***********************************************************************************************************/
        $validator->add(
            [
                "userid",
                "fname",
                "email",
                "phonenumber",
                "username",
                "password",
                "city",
            ],
            new PresenceOf(
                [
                    "message" => [
                        "userid" => ":field is required",
                        "fname" => ":field is required",
                        "email" => ":field is required",
                        "phonenumber" => ":field is required",
                        "username" => ":field is required",
                        "password" => ":field is required",
                        "city" => ":field is required",
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
        /*$validator->add(
            "datebirth",
            new DateValidator(
                [
                    "format"  => "Y-m-d",
                    "message" => ":field is invalid",
                ]
            )
        );*/
        return $this->validate($validator);
    }
}