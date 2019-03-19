<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness  as UniquenessValidator;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\Inclusionin;
use Phalcon\Validation\Validator\Regex;


class Orderfood extends Model
{

	// Columns
    public $orderid;
    public $orderdate;
    public $ordertime;
    public $expectedtime;
    public $afterminutes;
    public $status;
    public $restauname;
    public $foodid;
    public $foodname;
    public $foodprice;
    public $foodqty;
    public $userid;
    public $orderyear;
    public $ordermonth;
    public $orderday;
    public $ordercode;

	// Validations
    public function validation(){

        $validator = new Validation();

        /************************************************************************************************************
         *                              CHECK UNIQUENESS OF SOME FIELDS (DUPLICATED VALUES ARE NOT ALLOWED)
         ***********************************************************************************************************/
        /*$validator->add(
            'orderid',
            new UniquenessValidator([
                'model' => new Orderfood(),
                'message' => ':field must be unique',
            ])
        );*/
        /************************************************************************************************************
         *                              CHECK PRESENCE OF SOME FIELDS (NULL VALUES ARE NOT ACCEPTED)
         ***********************************************************************************************************/
        $validator->add(
            [
                "orderid",
                "orderdate",
                "ordertime",
                "status",
                "restauname",
                "foodid",
                "foodname",
                "foodprice",
                "foodqty",
                "userid",
                "orderyear",
                "ordermonth",
                "orderday",
                "ordercode",
            ],
            new PresenceOf(
                [
                    "message" => [
                        "orderid" => ":field is required",
                        "orderdate" => ":field is required",
                        "ordertime" => ":field is required",
                        "status" => ":field is required",
                        "restauname" => ":field is required",
                        "foodid" => ":field is required",
                        "foodname" => ":field is required",
                        "foodprice" => ":field is required",
                        "foodqty" => ":field is required",
                        "userid" => ":field is required",
                        "orderyear" => ":field is required",
                        "ordermonth" => ":field is required",
                        "orderday" => ":field is required",
                        "ordercode" => ":field is required",
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