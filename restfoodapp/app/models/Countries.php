<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness  as UniquenessValidator;
use Phalcon\Validation\Validator\Inclusionin;
use Phalcon\Validation\Validator\Regex;


class Countries extends Model
{

	// Columns
    public $cid;
    public $countryname;
    public $status;

	// Validations
    public function validation(){

        $validator = new Validation();

        /************************************************************************************************************
         *                              CHECK UNIQUENESS OF SOME FIELDS (DUPLICATED VALUES ARE NOT ALLOWED)
         ***********************************************************************************************************/
        /*$validator->add(
            'cid',
            new UniquenessValidator([
                'model' => new Countries(),
                'message' => ':field must be unique',
            ])
        );*/

        $validator->add(
            'countryname',
            new UniquenessValidator([
                'model' => new Countries(),
                'message' => ':field must be unique',
            ])
        );

        /************************************************************************************************************
         *                              CHECK PRESENCE OF SOME FIELDS (NULL VALUES ARE NOT ACCEPTED)
         ***********************************************************************************************************/
        $validator->add(
            [
                "cid",
                "countryname",
                "status",
            ],
            new PresenceOf(
                [
                    "message" => [
                        "cid" => ":field is required",
                        "countryname" => ":field is required",
                        "status" => ":field is required",
                    ],
                ]
            )
        );
        return $this->validate($validator);
    }
}