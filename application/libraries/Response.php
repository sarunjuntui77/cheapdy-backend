<?php
/**
*    @category    Library
*    @author      Sarun Juntui
*    @link        http://example.com
*    @modified    02/10/2017
*    @comment     for help api response
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Response {

    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function send($data)
    {
        $response = [
            'resultCode' => $data['code'],
            'data' => $data['data']
        ];
        return $this->ci->output
        ->set_content_type('application/json', 'UTF-8')
        ->set_output(json_encode($response, 
            // JSON_PRETTY_PRINT | 
            JSON_UNESCAPED_UNICODE | 
            JSON_UNESCAPED_SLASHES));
    }

    public function incorrect_method()
    {
        $response = [
            'resultCode' => '500',
            'data' => ['message' => 'Incorrect method']
        ];
        return $this->ci->output
        ->set_content_type('application/json', 'UTF-8')
        ->set_output(json_encode($response, 
            // JSON_PRETTY_PRINT | 
            JSON_UNESCAPED_UNICODE | 
            JSON_UNESCAPED_SLASHES));
    }

}