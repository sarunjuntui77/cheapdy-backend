<?php
use DusanKasan\Knapsack\Collection;

/**
*    @category    Library
*    @author      Sarun Juntui
*    @link        http://example.com
*    @modified    06/10/2017
*    @comment     function for manage data from wordpress
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Wordpress {
    protected $ci;
    protected $use_meta;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->use_meta = [
            [ 
                'key' => 'geolocation_lat',
                'rename' => 'lat',
            ],
            [ 
                'key' => 'geolocation_long',
                'rename' => 'long',
            ],
            [ 
                'key' => '_gallery_images',
                'rename' => 'gallery',
            ],
            [ 
                'key' => '_job_location',
                'rename' => 'location',
            ],
            [ 
                'key' => '_company_facebook',
                'rename' => 'facebook',
            ],
            [ 
                'key' => '_phone',
                'rename' => 'phone',
            ],
            
        ];
    }

    public function get_post($id)
    {
        $post = $this->ci->wordpress_model->get_by_id($id);
        $post = $this->fetch_post_frontend($post);
        return isset($post[0]) ? $post[0] :  new stdClass();
    }

    public function get_posts()
    {
        $posts = $this->ci->wordpress_model->get(27);
        $images = $this->ci->wordpress_model->get_images();
        $posts = $this->fetch_posts_frontend($posts, $images);
        return $posts;
    }

    public function get_meta($id)
    {
        $meta = $this->ci->wordpress_model->get_meta($id);
        $meta = $this->fetch_meta_frontend($meta);
        return $meta;
    }

    public function get_tax($id)
    {
        $taxs = $this->ci->wordpress_model->get_tax($id);
        $taxs = $this->fetch_taxs_frontend($taxs);
        return $taxs;
    }

    public function fetch_posts_frontend($posts, $images)
    {
        $parse = [];
        $images = Collection::from($images)
        ->indexBy(function ($value) {
            return $value->post_parent;
        })->toArray();
        foreach ($posts as $key => $value) {
            array_push($parse, [
                'id' => $value->ID,
                'name' => $value->post_name,
                'title' => $value->post_title,
                'images' => $images[$value->ID]->guid
            ]);
        }
        return $parse;
    }

    public function fetch_post_frontend($post)
    {
        $parse = [];
        foreach ($post as $key => $value) {
            $value->post_content = str_replace("\r\n", "<br>" ,$value->post_content);
            $value->post_content = str_replace("\n\r", "<br>" ,$value->post_content);
            $value->post_content = str_replace("\r", "<br>" ,$value->post_content);
            $value->post_content = str_replace("\n", "<br>" ,$value->post_content);
            $value->post_content = str_replace("\"", "" ,$value->post_content);
            array_push($parse, [
                'id' => $value->ID,
                'name' => $value->post_name,
                'title' => $value->post_title,
                'content' => $value->post_content,
            ]);
        }
        return $parse;
    }

    public function fetch_meta_frontend($meta)
    {
        $meta = Collection::from($meta)
        ->indexBy(function ($value) {
            return $value->meta_key;
        })->toArray();

        $parse = [];
        foreach ($this->use_meta as $key => $value) {
            $parse[$value['rename']] = (isset($meta[$value['key']]->meta_value))? $meta[$value['key']]->meta_value: '';
        }
        $parse['gallery'] = $this->ci->text->text_in_quotes($parse['gallery']);

        return $parse;
    }

    public function fetch_taxs_frontend($taxs)
    {
        $taxs = Collection::from($taxs)
        ->indexBy(function ($value) {
            return $value->taxonomy;
        })->toArray();

        return $taxs;
    }
}