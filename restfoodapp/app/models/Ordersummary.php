<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness  as UniquenessValidator;
use Phalcon\Validation\Validator\Date as DateValidator;


class Ordersummary extends Model
{

	// Columns
    public $id;
    public $ordercode;
    public $restauname;
    public $orderdate;
    public $ordertime;
    public $status;
    public $totalprice;
    public $totalqty;
    public $year;
    public $month;
    public $day;
    public $orderrating;
    public $otherinfo;
    public $reasoncanceled;
    public $reasondeleted;
    public $ordernotification;

	// Validations
    public function validation(){

        $validator = new Validation();

        /************************************************************************************************************
         *                              CHECK UNIQUENESS OF SOME FIELDS (DUPLICATED VALUES ARE NOT ALLOWED)
         ***********************************************************************************************************/
        /*$validator->add(
            'id',
            new UniquenessValidator([
                'model' => new Ordersummary(),
                'message' => ':field must be unique',
            ])
        );*/

        $validator->add(
            'ordercode',
            new UniquenessValidator([
                'model' => new Ordersummary(),
                'message' => ':field must be unique',
            ])
        );
        /************************************************************************************************************
         *                              CHECK PRESENCE OF SOME FIELDS (NULL VALUES ARE NOT ACCEPTED)
         ***********************************************************************************************************/
        $validator->add(
            [
                "id",
                "ordercode",
                "userid",
                "restauname",
                "orderdate",
                "ordertime",
                "status",
                "totalprice",
                "totalqty",
                "year",
                "month",
                "day",
            ],
            new PresenceOf(
                [
                    "message" => [
                        "id" => ":field is required",
                        "ordercode" => ":field is required",
                        "userid" => ":field is required",
                        "restauname" => ":field is required",
                        "orderdate" => ":field is required",
                        "ordertime" => ":field is required",
                        "status" => ":field is required",
                        "totalprice" => ":field is required",
                        "totalqty" => ":field is required",
                        "year" => ":field is required",
                        "month" => ":field is required",
                        "day" => ":field is required",
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