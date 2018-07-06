<?php
/**
*    @category    Library
*    @author      Sarun Juntui
*    @link        http://example.com
*    @modified    02/10/2017
*    @comment     for date function
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Date_ui {
    protected $thai_month;

    public function __construct()
    {
        $this->thai_month = [
            "0"=>"",
            "1"=>"มกราคม",
            "2"=>"กุมภาพันธ์",
            "3"=>"มีนาคม",
            "4"=>"เมษายน",
            "5"=>"พฤษภาคม",
            "6"=>"มิถุนายน", 
            "7"=>"กรกฎาคม",
            "8"=>"สิงหาคม",
            "9"=>"กันยายน",
            "10"=>"ตุลาคม",
            "11"=>"พฤศจิกายน",
            "12"=>"ธันวาคม"                 
            ];
    }

    public function get_thai_format($date_string)
    {
        $date_r = getdate(strtotime($date_string));
        $full_text = $date_r['mday'].' '
        .$this->thai_month[$date_r['mon']].' '
        .($date_r['year']+543);
        return $full_text;
    }

    public function time_only($date_string)
    {
        $date_r = explode(' ', $date_string);
        return $date_r[1];
    }
}