<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ValiDateMSISDN{

    public $CI;

    function __construct()
    {

        $this->CI =& get_instance();

    }



    public function msisdnCleaner($textFileData)
    {
        $msisdnArray = preg_split('/\R/', $textFileData);
        $i='0';
        foreach($msisdnArray as $msisdns)
        {

            //eliminate every char except 0-9
            $cleanMSISDN[$i] = preg_replace("/[^0-9]/", '', $msisdns);

            //eliminate leading 1 if its there
            if (strlen($cleanMSISDN[$i]) == 11)
            {
                $cleanMSISDN[$i] = '88'.$cleanMSISDN[$i];

            }
            if(strlen($cleanMSISDN[$i]) == 10)
            {
                $cleanMSISDN[$i] = '880'.$cleanMSISDN[$i];

            }
            $i++;
        }

        return $cleanMSISDN;
    }




}