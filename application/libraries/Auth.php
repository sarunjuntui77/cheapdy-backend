<?php
/**
*    @category    Library
*    @author      Sarun Juntui
*    @link        http://example.com
*    @modified    02/10/2017
*    @comment     for authorization api
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth {

    protected $ci;
    protected $expiration;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

}