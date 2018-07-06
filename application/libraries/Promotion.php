<?php
/**
*    @category    Library
*    @author      Sarun Juntui
*    @link        http://example.com
*    @modified    06/10/2017
*    @comment     function for manage promotion data
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Promotion {
    protected $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function get_by_provider($number)
    {
        $promotion = $this->ci->promotion_model->get_by_provider_date($number);
        $promotion = $this->fetch_promotions_frontend($promotion);
        return isset($promotion[0]) ? $promotion[0] :  new stdClass();
    }

    public function get_promotions()
    {
        $promotions = $this->ci->promotion_model->get();
        $promotions = $this->fetch_promotions_frontend($promotions);
        return $promotions;
    }

    public function get_relate_category($data)
    {
        $promotions = $this->ci->promotion_model->get_like_category($data);
        $promotions = $this->fetch_promotions_frontend($promotions);
        return $promotions;
    }

    public function fetch_promotions_frontend($promotions)
    {
        $parse = [];
        foreach ($promotions as $key => $value) {
            array_push($parse, [
               'number' =>  $value->promotion_number,
               'title' =>  $value->promotion_title,
               'desc' =>  $value->promotion_desc,
               'discount' =>  $value->promotion_dis_price,
               'qty' =>  $value->promotion_qty,
               'maxQty' =>  $value->promotion_max_qty,
               'image' =>  $value->promotion_image_url,
               'providerId' =>  $value->provider_id,
               'provider' =>  $value->provider_name,
               'category' =>  $value->provider_category,
               'region' =>  $value->provider_region,
           ]);
        }
        return $parse;
    }

    public function fetch_post_frontend($post)
    {
        return [
            'id' => $post->ID,
            'name' => $post->post_name,
            'title' => $post->post_title,
            'content' => $post->post_content,
        ];
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
}