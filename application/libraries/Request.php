<?php
/**
*    @category    Library
*    @author      Sarun Juntui
*    @link        http://example.com
*    @modified    02/10/2017
*    @comment     for help api request
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Request {

    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->white_list = ['https://cheapdy.com'];
    }

    public function bootstrap()
    {
        $this->cors();
    }

    public function cors()
    {
        header('Content-Type: application/json; charset=UTF-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        // if (isset($_SERVER['HTTP_ORIGIN'])) {
        //     header("Access-Control-Allow-Origin: *");
        //     header('Access-Control-Allow-Credentials: true');
        //     header('Access-Control-Max-Age: 0'); 
        // }
        // if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        //     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        //         header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        //     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        //         header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        //     exit(0);
        // }

    }

}