<?php
/**
*    @category    Library
*    @author      Sarun Juntui
*    @link        http://example.com
*    @modified    02/10/2017
*    @comment     for device function
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Device {
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function get_device()
    {
        if ($this->ci->agent->is_mobile()) {
            $agent = $this->ci->agent->mobile();
        } else {
            if ($this->ci->agent->is_browser()) {
                $agent = $this->ci->agent->browser().' '.$this->ci->agent->version();
            } 
            elseif ($this->ci->agent->is_robot()) {
                $agent = $this->ci->agent->robot();
            } else {
                $agent = 'Unidentified User Agent';
            }
        }

        return $agent;
    }
}