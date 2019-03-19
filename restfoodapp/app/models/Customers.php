<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness  as UniquenessValidator;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\Inclusionin;
use Phalcon\Validation\Validator\Regex;


class Customers extends Model
{

	// Columns
    public $id;
    public $userid;
    public $fullname;
    public $email;
    public $phonenumber;
    public $city;
    public $address;
    public $idresto;
    public $photo;
    public $customerrating;
    public $restorating;
    public $restocomments;
    public $otherinfo;
    public $allownotifications;

	// Validations
    public function validation(){

        $validator = new Validation();

        /************************************************************************************************************
         *                              CHECK UNIQUENESS OF SOME FIELDS (DUPLICATED VALUES ARE NOT ALLOWED)
         ***********************************************************************************************************/
        $validator->add(
			[
				"email",
				"idresto",
			],
			new UniquenessValidator(
				[
					"model"   => new Customers(),
					"message" => ":field must be unique",
				]
			)
		);
        /************************************************************************************************************
         *                              CHECK PRESENCE OF SOME FIELDS (NULL VALUES ARE NOT ACCEPTED)
         ***********************************************************************************************************/
        $validator->add(
            [
                "id",
                "userid",
                "fullname",
                "email",
                "phonenumber",
                "city",
                "address",
                "idresto",
                "allownotifications",
                "membershipdate",
            ],
            new PresenceOf(
                [
                    "message" => [
                        "id" => ":field is required",
                        "userid" => ":field is required",
                        "fullname" => ":field is required",
                        "email" => ":field is required",
                        "phonenumber" => ":field is required",
                        "city" => ":field is required",
                        "address" => ":field is required",
                        "idresto" => ":field is required",
                        "allownotifications" => ":field is required",
                        "membershipdate" => ":field is required",
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
            "membershipdate",
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