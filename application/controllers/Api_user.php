<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_user extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->request->bootstrap();
        $this->load->library('register');
        $this->load->library('text');
        $this->load->library('coupon');
        $this->load->library('ip');
        $this->load->library('mail');
        $this->load->library('date_ui');
        $this->load->library('ui');
        $this->load->library('alert');
        $this->load->library('device');
        $this->load->library('email');
        $this->load->model('user_model');
        $this->load->model('coupon_model');
        $this->input = json_decode(file_get_contents('php://input'), TRUE);
    }

    function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->register->process($this->input);
            $response = [
                'data' => $result[1],
                'code' => $result[0]
            ];
            return $this->response->send($response);
        } else {
            return $this->response->incorrect_method();
        }
    }

    function verify_email()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->register->verify_mail($this->input);
            $response = [
                'data' => $result[1],
                'code' => $result[0]
            ];
            return $this->response->send($response);
        } else {
            return $this->response->incorrect_method();
        }
    }

    function check_new_user()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        } else {
            return $this->response->incorrect_method();
        }
    }

}