<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_coupon extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->request->bootstrap();
        $this->load->library('text');
        $this->load->library('coupon');
        $this->load->library('ip');
        $this->load->library('mail');
        $this->load->library('date_ui');
        $this->load->library('alert');
        $this->load->library('device');
        $this->load->library('email');
        $this->load->model('promotion_model');
        $this->load->model('coupon_model');
        $this->input = json_decode(file_get_contents('php://input'), TRUE);
    }

    function register_code()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->coupon->get_coupon($this->input);
            $response = [
                'code' => $result[0],
                'data' => ['message' => $result[1]]
            ];
            return $this->response->send($response);
        } else {
            return $this->response->incorrect_method();
        }
    }

    function cancel_code()
    {
    }

    function check_quota_ip()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $ip = $this->ip->get_client_ip();
            $qouta_daily = $this->coupon_model->count_ip_date($ip);
            $response = [
                'code' => '200',
                'data' => [
                    'quotaIp' => $qouta_daily,
                ]
            ];

            return $this->response->send($response);
        } else {
            return $this->response->incorrect_method();
        }
    }

    function check_quota_ip_number($number='')
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $ip = $this->ip->get_client_ip();
            $qouta_daily = $this->coupon_model->count_ip_date($ip);
            $qouta_current = $this->coupon_model->count_ip_date_number($ip, $number);
            $response = [
                'code' => '200',
                'data' => [
                    'quotaIp' => $qouta_daily,
                    'quotaPromotion' => $qouta_current
                ]
            ];

            return $this->response->send($response);
        } else {
            return $this->response->incorrect_method();
        }
    }
}