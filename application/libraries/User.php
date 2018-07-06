<?php
/**
*    @category    Library
*    @author      Sarun Juntui
*    @link        http://example.com
*    @modified    26/10/2017
*    @comment     for help user data
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class User {
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }
}