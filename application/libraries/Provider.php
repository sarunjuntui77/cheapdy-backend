<?php
use DusanKasan\Knapsack\Collection;

/**
*    @category    Library
*    @author      Sarun Juntui
*    @link        http://example.com
*    @modified    31/10/2017
*    @comment     function for manage data from wordpress
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Provider {
    protected $ci;
    protected $use_meta;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function get_by_id($id)
    {
        $provider = $this->ci->provider_model->get_by_id($id);
        $provider = $this->fetch_frontend($provider);
        return isset($provider[0]) ? $provider[0] :  new stdClass();
    }

    public function get_categories()
    {
        $categories = $this->ci->provider_model->get_categories();
        $categories = $this->fetch_categories_frontend($categories);
        return $categories;
    }

    public function fetch_frontend($providers)
    {
        $parse = [];
        foreach ($providers as $key => $value) {
            $parse[$key]['id'] = $value->provider_id;
            $parse[$key]['title'] = $value->provider_title;
            $parse[$key]['content'] = $value->provider_content;
            $parse[$key]['status'] = $value->provider_status;
            $parse[$key]['imageUrl'] = $value->provider_image_url;
            $parse[$key]['lat'] = doubleval($value->provider_lat);
            $parse[$key]['long'] = doubleval($value->provider_long);
            $parse[$key]['gallery'] = explode(',', $value->provider_gallery);
            $parse[$key]['address'] = $value->provider_address;
            $parse[$key]['facebook'] = $value->provider_facebook;
            $parse[$key]['phone'] = $value->provider_phone;
            $parse[$key]['youtube'] = $value->provider_vdo_url;
            $parse[$key]['categoryId'] = $value->category_id;
            $parse[$key]['category'] = $value->category_name;
            $parse[$key]['region'] = $value->provider_region;
        }
        return $parse;
    }

    public function fetch_categories_frontend($categories)
    {
        $parse = [];
        foreach ($categories as $key => $value) {
            array_push($parse, $value->category_name);
        }
        return $parse;
    }
}