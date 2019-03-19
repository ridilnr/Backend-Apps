<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness  as UniquenessValidator;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\Inclusionin;
use Phalcon\Validation\Validator\Regex;

class Foods extends Model
{

	// Columns
    public $foodid;
    public $restoid;
    public $restauname;
    public $foodname;
    public $photo;
    public $price;
    public $description;
    public $type;
    public $available;
    public $dateinserted;
    public $lastupdateddate;
    public $discount;
    public $size;


    // Validations
    public function validation(){

        $validator = new Validation();

        /************************************************************************************************************
         *                              CHECK UNIQUENESS OF SOME FIELDS (DUPLICATED VALUES ARE NOT ALLOWED)
         ***********************************************************************************************************/
        /*$validator->add(
            'foodid',
            new UniquenessValidator([
                'model' => new Foods(),
                'message' => ':field must be unique',
            ])
        );*/
        /************************************************************************************************************
         *                              CHECK PRESENCE OF SOME FIELDS (NULL VALUES ARE NOT ACCEPTED)
         ***********************************************************************************************************/
        $validator->add(
            [
                "foodid",
                "restoid",
                "restauname",
                "foodname",
                "photo",
                "price",
                "available",
                "dateinserted",
            ],
            new PresenceOf(
                [
                    "message" => [
                        "foodid" => ":field is required",
                        "restoid" => ":field is required",
                        "restauname" => ":field is required",
                        "foodname" => ":field is required",
                        "photo" => ":field is required",
                        "price" => ":field is required",
                        "available" => ":field is required",
                        "dateinserted" => ":field is required",
                    ],
                ]
            )
        );
        /************************************************************************************************************
         *                              CHECK VALIDITY OF A DATE
         ***********************************************************************************************************/
        $validator->add(
            "dateinserted",
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