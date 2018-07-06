<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_promotion extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->request->bootstrap();
        $this->load->library('promotion');
        $this->load->model('promotion_model');
        $this->input = json_decode(file_get_contents('php://input'), TRUE);
    }

    function get_daily()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->promotion->get_promotions();
            $response = [
                'data' => $data,
                'code' => '200'
            ];
            return $this->response->send($response);
        } else {
            return $this->response->incorrect_method();
        }
    }

    function get_by_provider($number)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->promotion->get_by_provider($number);
            $response = [
                'data' => $data,
                'code' => '200'
            ];
            return $this->response->send($response);
        } else {
            return $this->response->incorrect_method();
        }
    }

    function get_relate_category()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->promotion->get_relate_category($this->input);
            $response = [
                'data' => $data,
                'code' => '200'
            ];
            return $this->response->send($response);
        } else {
            return $this->response->incorrect_method(); 
        }
    }

    function index()
    {
        return $this->response->send();
    }
}
