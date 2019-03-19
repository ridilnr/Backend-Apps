<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness  as UniquenessValidator;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\Inclusionin;
use Phalcon\Validation\Validator\Regex;


class Oldorderdrink extends Model
{

    // Columns
    public $id;
    public $orderid;
    public $ordercode;
    public $drinkid;
    public $drinkname;
    public $drinkprice;
    public $drinkqty;
    public $orderdate;
    public $ordertime;
    public $expectedtime;
    public $afterminutes;
    public $status;
    public $userid;
    public $orderyear;
    public $ordermonth;
    public $orderday;
    public $restauname;

    // Validations
    public function validation(){

        $validator = new Validation();

        /************************************************************************************************************
         *                              CHECK UNIQUENESS OF SOME FIELDS (DUPLICATED VALUES ARE NOT ALLOWED)
         ***********************************************************************************************************/
        /*$validator->add(
            'id',
            new UniquenessValidator([
                'model' => new Oldorderdrink(),
                'message' => ':field must be unique',
            ])
        );*/
        /************************************************************************************************************
         *                              CHECK PRESENCE OF SOME FIELDS (NULL VALUES ARE NOT ACCEPTED)
         ***********************************************************************************************************/
        $validator->add(
            [
                "id",
                "orderid",
                "ordercode",
                "orderdate",
                "ordertime",
                "status",
                "userid",
                "orderyear",
                "ordermonth",
                "orderday",
                "restauname",
            ],
            new PresenceOf(
                [
                    "message" => [
                        "id" => ":field is required",
                        "orderid" => ":field is required",
                        "ordercode" => ":field is required",
                        "orderdate" => ":field is required",
                        "ordertime" => ":field is required",
                        "status" => ":field is required",
                        "userid" => ":field is required",
                        "orderyear" => ":field is required",
                        "ordermonth" => ":field is required",
                        "orderday" => ":field is required",
                        "restauname" => ":field is required",
                    ],
                ]
            )
        );
        /************************************************************************************************************
         *                              CHECK VALIDITY OF A DATE
         ***********************************************************************************************************/
        $validator->add(
            "orderdate",
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