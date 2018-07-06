<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_provider extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->request->bootstrap();
        $this->load->library('text');
        $this->load->library('wordpress');
        $this->load->library('provider');
        $this->load->model('wordpress_model');
        $this->load->model('provider_model');
        $this->input = json_decode(file_get_contents('php://input'), TRUE);
    }

    function get_categories()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $categories = $this->provider->get_categories();
            $response = [
                'code' => '200',
                'data' =>  $categories,
            ];
            return $this->response->send($response);
        } else {
            return $this->response->incorrect_method();
        }
    }

    function get_provider_content($id='')
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $provider = $this->provider->get_by_id($id);
            $response = [
                'code' => '200',
                'data' => $provider
            ];
            return $this->response->send($response);
        } else {
            return $this->response->incorrect_method();
        }
    }

    function get_wordpress_listting()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $post = $this->wordpress->get_posts();
            $response = [
                'code' => '200',
                'data' =>  $post,
            ];
            return $this->response->send($response);
        } else {
            return $this->response->incorrect_method();
        }
    }

    function get_wordpress_categories()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $category = $this->wordpress_model->get_categories();
            $response = [
                'code' => '200',
                'data' =>  $category,
            ];
            return $this->response->send($response);
        } else {
            return $this->response->incorrect_method();
        }
    }

    function get_relate_provider($category)
    {
    }
}