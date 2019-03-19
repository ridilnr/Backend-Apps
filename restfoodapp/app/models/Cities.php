<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness  as UniquenessValidator;
use Phalcon\Validation\Validator\Inclusionin;
use Phalcon\Validation\Validator\Regex;


class Cities extends Model
{

	// Columns
    public $cityid;
    public $cityname;
    public $countryname;
    public $description;
    public $otherinfo;
    public $status;

	// Validations
    public function validation(){

        $validator = new Validation();

        /************************************************************************************************************
         *                              CHECK UNIQUENESS OF SOME FIELDS (DUPLICATED VALUES ARE NOT ALLOWED)
         ***********************************************************************************************************/
        /*$validator->add(
            'cityid',
            new UniquenessValidator([
                'model' => new Cities(),
                'message' => ':field must be unique',
            ])
        );*/

        /************************************************************************************************************
         *                              CHECK PRESENCE OF SOME FIELDS (NULL VALUES ARE NOT ACCEPTED)
         ***********************************************************************************************************/
        $validator->add(
            [
                "cityid",
                "cityname",
                "countryname",
                "status",
            ],
            new PresenceOf(
                [
                    "message" => [
                        "cityid" => ":field is required",
                        "cityname" => ":field is required",
                        "countryname" => ":field is required",
                        "status" => ":field is required",
                    ],
                ]
            )
        );

        return $this->validate($validator);
    }
}