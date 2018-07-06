<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_auth extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->request->bootstrap();
    }

    function login()
    {
    }

    function logout()
    {
    }

    function get_session_id()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->load->library('session');
            $response = [
                'code' => '200',
                'data' => ['authId' => session_id()]
            ];
            return $this->response->send($response);
        } else {
            return $this->response->incorrect_method();
        }
    }

    function get_session_data()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->load->library('session');
            if ($this->session->userdata('user')) {
                $response =  [
                    'code' => '200',
                    'data' => ['auth' => $this->session->userdata()]
                ];
            } else {
                $response =  [
                    'code' => '400',
                    'data' => ['auth' => []]
                ];
            }
            return $this->response->send($response);
        } else {
            return $this->response->incorrect_method();
        }
    }
}
?>