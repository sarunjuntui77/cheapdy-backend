<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->request->bootstrap();
        $this->load->library('text');
        $this->load->library('wordpress');
        $this->load->model('wordpress_model');
    }

    function wordpress($id)
    {
        header('Content-Type: application/json; charset=UTF-8');
        $providers = (array)$this->wordpress_model->get();
        foreach ($providers as $key => $value) {
            $providers[$key] = (array)$value;
            $meta = $this->wordpress->get_meta($value->ID);
            $tax = $this->wordpress->get_tax($value->ID);
            $providers[$key]['lat'] = $meta['lat'];
            $providers[$key]['long'] = $meta['long'];
            $providers[$key]['gallery'] = implode(',', $meta['gallery']);
            $providers[$key]['location'] = $meta['location'];
            $providers[$key]['facebook'] = $meta['facebook'];
            $providers[$key]['phone'] = $meta['phone'];
            $providers[$key]['category'] = $tax['job_listing_category']->name;
            $providers[$key]['region'] = $tax['job_listing_region']->name;

        }
        print_r($providers);
    }

    function index()
    {
        $this->load->library('encrypt');
        $this->load->library('text');
        $msg = 'notmypassword ';
        echo md5($msg);
        echo "<br>";
        echo sha1(str)($msg);
    }

    function session()
    {
        echo "<pre>";
        print_r($_SERVER);
        session_start();
        // $this->load->library('session');
        $newdata = array(
            'username'  => 'johndoe',
            'email'     => 'johndoe@some-site.com',
            'logged_in' => TRUE,
        );

        // $this->session->set_userdata($newdata);

        session_id('438po1fhmcvhf2ri41b5tq7t10birrjb');
        echo "<pre>";
        // print_r(session_id());
        // print_r($this->session->userdata);
        // print_r($_SERVER);
        session_destroy();
    }
}