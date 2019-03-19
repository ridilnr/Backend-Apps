<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness  as UniquenessValidator;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\Inclusionin;
use Phalcon\Validation\Validator\Regex;

class Drinks extends Model
{

	// Columns
    public $drinkid;
    public $restoid;
    public $restauname;
    public $drinkname;
    public $type;
    public $price;
    public $available;
    public $dateinserted;
    public $lastupdateddate;
    public $discount;
    public $description;
    public $size;
    public $photo;

	// Validations
    public function validation(){

        $validator = new Validation();

        /************************************************************************************************************
         *                              CHECK UNIQUENESS OF SOME FIELDS (DUPLICATED VALUES ARE NOT ALLOWED)
         ***********************************************************************************************************/
        /*$validator->add(
            'drinkid',
            new UniquenessValidator([
                'model' => new Drinks(),
                'message' => ':field must be unique',
            ])
        );*/
        /************************************************************************************************************
         *                              CHECK PRESENCE OF SOME FIELDS (NULL VALUES ARE NOT ACCEPTED)
         ***********************************************************************************************************/
        $validator->add(
            [
                "drinkid",
                "restoid",
                "restauname",
                "drinkname",
                "price",
                "available",
                "dateinserted",
                "photo",
            ],
            new PresenceOf(
                [
                    "message" => [
                        "drinkid" => ":field is required",
                        "restoid" => ":field is required",
                        "restauname" => ":field is required",
                        "drinkname" => ":field is required",
                        "price" => ":field is required",
                        "available" => ":field is required",
                        "dateinserted" => ":field is required",
                        "photo" => ":field is required",
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