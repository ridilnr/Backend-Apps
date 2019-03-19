<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness  as UniquenessValidator;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\Inclusionin;
use Phalcon\Validation\Validator\Regex;


class Adminrestaurant extends Model
{

	// Columns
    public $idresto;
    public $email;
    public $username;
    public $password;
    public $status;
    public $type;
    public $pwupdatecode;
    public $pwupdatelink;
    public $datecreation;
    public $lastupdatedate;
    public $lastlogindate;
    public $description;
    public $otherinfo;
    public $datebirth;
    public $gender;
    public $phonenumber;
    public $restauname;
    public $city;
    public $country;
    public $deliverystarttime;
    public $deliverystoptime;
    public $photo;
    public $address;
    public $connectivity;
    public $restorate;

    // Validations
    public function validation(){

        $validator = new Validation();

        /************************************************************************************************************
         *                              CHECK UNIQUENESS OF SOME FIELDS (DUPLICATED VALUES ARE NOT ALLOWED)
         ***********************************************************************************************************/
        /*$validator->add(
            'idresto',
            new UniquenessValidator([
                'model' => new Adminrestaurant(),
                'message' => ':field must be unique',
            ])
        );*/

        $validator->add(
            'email',
            new UniquenessValidator([
                'model' => new Adminrestaurant(),
                'message' => ':field must be unique',
            ])
        );

        $validator->add(
            'username',
            new UniquenessValidator([
                'model' => new Adminrestaurant(),
                'message' => ':field must be unique',
            ])
        );

        $validator->add(
            'restauname',
            new UniquenessValidator([
                'model' => new Adminrestaurant(),
                'message' => ':field must be unique',
            ])
        );
        /************************************************************************************************************
         *                              CHECK PRESENCE OF SOME FIELDS (NULL VALUES ARE NOT ACCEPTED)
         ***********************************************************************************************************/
        $validator->add(
            [
                "idresto",
                "email",
                "username",
                "password",
                "status",
                "type",
                "datecreation",
                "restauname",
                "city",
                "country",
                "address",
                "connectivity",
                "restorate",
            ],
            new PresenceOf(
                [
                    "message" => [
                        "idresto" => ":field is required",
                        "email" => ":field is required",
                        "username" => ":field is required",
                        "password" => ":field is required",
                        "status" => ":field is required",
                        "type" => ":field is required",
                        "datecreation" => ":field is required",
                        "restauname" => ":field is required",
                        "city" => ":field is required",
                        "country" => ":field is required",
                        "address" => ":field is required",
                        "connectivity" => ":field is required",
                        "restorate" => ":field is required",
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